<?php

namespace App\Tests\Functional;

use App\Entity\Area;
use App\Entity\Site;
use App\Repository\AreaRepository;
use App\Repository\SiteRepository;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AreaResourceTest extends AuthApiTestCase
{
    public function testUnauthenticatedGetCollection(): void
    {
        $response = $this->request(
            'GET',
            '/api/areas'
        );
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollection(): void
    {
        $this->authenticate();
        $response = $this->request(
            'GET',
            '/api/areas'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testPostWithAdminUser(): void
    {
        $this->addAreaRequest([
            'code' => 'X',
            'name' => 'New area X',
            'site' => $this->getSiteResourceIdentifierByCode('TH'),
        ]);
        $this->assertResponseStatusCodeSame(201);
    }

    public function testPatchWithAdminUser(): void
    {
        $response = $this->addAreaRequest([
            'code' => 'W',
            'name' => 'New area W',
            'site' => $this->getSiteResourceIdentifierByCode('TH'),
        ]);
        $this->assertResponseIsSuccessful();
        $newName = 'New area W (changed)';
        $response = $this->patchRequest(
            sprintf('/api/areas/%s', $this->getIdFromResponse($response)),
            [
                'name' => $newName,
            ]
        );
        $this->assertResponseIsSuccessful();
        $newResource = json_decode($response->getContent(), true);
        $this->assertEquals($newName, $newResource['name']);
    }

    public function testDeleteWithAdminUser(): void
    {
        $response = $this->addAreaRequest([
            'code' => 'ZD',
            'name' => 'New area ZD',
            'site' => $this->getSiteResourceIdentifierByCode('TH'),
        ]);
        $this->assertResponseIsSuccessful();
        $this->request(
            'GET',
            sprintf('/api/areas/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseIsSuccessful();
        $this->request(
            'DELETE',
            sprintf('/api/areas/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseStatusCodeSame(204);
        $this->request(
            'GET',
            sprintf('/api/areas/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseStatusCodeSame(404);
    }

    private function addAreaRequest(array $json): ResponseInterface
    {
        $this->authenticate(self::USER_ADMIN, self::USER_ADMIN_PW);

        return $this->request(
            'POST',
            '/api/areas',
            [
                'json' => $json,
            ]
        );
    }

    private function getSiteResourceIdentifierByCode(string $code): ?string
    {
        return sprintf('/api/sites/%s', $this->getSiteByCode($code)->getId());
    }

    private function getSiteByCode(string $code): ?Site
    {
        /** @var SiteRepository $repo */
        $repo = $this->getEntityRepository(Site::class);

        return $repo->findOneByCode($code);
    }

    public function invalidAreaDataProvider(): array
    {
        return [
            'blankCode' => ['', 'Area name', $this->getSiteResourceIdentifierByCode('TH')],
            'blankName' => ['RR', '', $this->getSiteResourceIdentifierByCode('WW')],
            // 'nullSite' => ['VV', 'Area name', null],
            'duplicateCode' => ['A', 'Area name', $this->getSiteResourceIdentifierByCode('TH')],
            'duplicateName' => ['ES', 'south', $this->getSiteResourceIdentifierByCode('TH')],
        ];
    }

    /**
     * @dataProvider invalidAreaDataProvider
     */
    public function testValidation($code, $name, $site): void
    {
        $this->addAreaRequest([
            'code' => $code,
            'name' => $name,
            'site' => $site,
        ]);
        $this->assertResponseStatusCodeSame(422);
    }

    public function operationsAuthDeniedProvider(): array
    {
        /** @var AreaRepository $repo */
        $repo = $this->getEntityRepository(Area::class);
        $area = $repo->findOneByCodes('TH', 'A');

        return [
            ['DELETE', self::USER_BASE, self::USER_BASE_PW, '/api/areas/'.$area->getId()],
            ['PATCH', self::USER_BASE, self::USER_BASE_PW, '/api/areas/'.$area->getId()],
            ['DELETE', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/areas/'.$area->getId()],
            ['PATCH', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/areas/'.$area->getId()],
        ];
    }

    /**
     * @dataProvider operationsAuthDeniedProvider
     */
    public function testItemOperationsAuthDenied($method, $username, $password, $url): void
    {
        $this->authenticate($username, $password);
        $this->assertResponseIsSuccessful();

        $this->request(
            $method,
            $url
        );
        $this->assertResponseStatusCodeSame(403);
    }
}
