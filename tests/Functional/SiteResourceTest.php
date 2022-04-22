<?php

namespace App\Tests\Functional;

use App\Entity\Site;
use App\Repository\SiteRepository;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SiteResourceTest extends AuthApiTestCase
{
    protected function getBaseResourceIri(): string
    {
        return 'sites';
    }

    public function testUnauthenticatedGetCollection(): void
    {
        $response = $this->request(
            'GET',
            '/api/sites'
        );
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollection(): void
    {
        $this->authenticate();
        $response = $this->request(
            'GET',
            '/api/sites'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testPostWithAdminUser(): void
    {
        $this->addSiteRequest([
           'code' => 'NW1',
           'name' => 'New site 1',
        ]);
        $this->assertResponseStatusCodeSame(201);
    }

    public function testPatchWithAdminUser(): void
    {
        $response = $this->addSiteRequest([
            'code' => 'NW2',
            'name' => 'New site 2',
        ]);
        $this->assertResponseIsSuccessful();
        $newSite = json_decode($response->getContent(), true);
        $newName = 'New site 2 (changed)';
        $response = $this->patchRequest(
            sprintf('/api/sites/%s', $newSite['id']),
            [
                'name' => $newName,
            ]
        );
        $this->assertResponseIsSuccessful();
        $newSite = json_decode($response->getContent(), true);
        $this->assertEquals($newName, $newSite['name']);
    }

    public function testDeleteWithAdminUser(): void
    {
        $response = $this->addSiteRequest([
            'code' => 'NW3',
            'name' => 'New site 3',
        ]);
        $this->assertResponseIsSuccessful();
        $this->request(
            'GET',
            sprintf('/api/sites/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseIsSuccessful();
        $this->request(
            'DELETE',
            sprintf('/api/sites/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseStatusCodeSame(204);
        $this->request(
            'GET',
            sprintf('/api/sites/%s', $this->getIdFromResponse($response))
        );
        $this->assertResponseStatusCodeSame(404);
    }

    public function invalidSiteDataProvider(): array
    {
        return [
            'blankCode' => ['', 'Site name'],
            'blankName' => ['RR', ''],
            'duplicateCode' => ['TH', 'Site name'],
            'duplicateName' => ['CV', 'Tell Hatarah'],
        ];
    }

    /**
     * @dataProvider invalidSiteDataProvider
     */
    public function testValidation($code, $name): void
    {
        $this->addSiteRequest([
            'code' => $code,
            'name' => $name,
        ]);
        $this->assertResponseStatusCodeSame(422);
    }

    private function addSiteRequest(array $json): ResponseInterface
    {
        $this->authenticate(self::USER_ADMIN, self::USER_ADMIN_PW);

        return $this->request(
            'POST',
            '/api/sites',
            [
                'json' => $json,
            ]
        );
    }

    public function operationsAuthDeniedProvider(): array
    {
        /** @var SiteRepository $repo */
        $repo = $this->getEntityRepository(Site::class);
        $site = $repo->findOneByCode('TH');

        return [
            ['DELETE', self::USER_BASE, self::USER_BASE_PW, '/api/sites/'.$site->getId()],
            ['PATCH', self::USER_BASE, self::USER_BASE_PW, '/api/sites/'.$site->getId()],
            ['DELETE', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/sites/'.$site->getId()],
            ['PATCH', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/sites/'.$site->getId()],
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
