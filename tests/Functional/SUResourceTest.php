<?php

namespace App\Tests\Functional;

use App\Entity\Area;
use App\Repository\AreaRepository;

class SUResourceTest extends AuthApiTestCase
{
    public function testUnauthenticatedGetCollection(): void
    {
        $response = $this->request(
            'GET',
            '/api/stratigraphic_units'
        );
        $this->assertResponseStatusCodeSame(401);
    }

    /**
     * @group wip
     */
    public function testGetCollection(): void
    {
        $this->authenticate();
        $response = $this->request(
            'GET',
            '/api/stratigraphic_units'
        );
        $this->assertResponseIsSuccessful();
    }

    public function testPostWithAdminUser(): void
    {
        $this->adminPostCollectionRequest(
            '/api/stratigraphic_units',
            [
                'area' => $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                'number' => 10,
                'date' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    /**
     * @group wip
     */
    public function testPostValidateDuplicateNumberInSite(): void
    {
        $this->adminPostCollectionRequest(
            '/api/stratigraphic_units',
            [
                'area' => $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                'number' => 1,
                'date' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
            ]
        );
        $this->assertResponseStatusCodeSame(422);
    }

    private function getAreaResourceIdentifierByCodes(string $siteCode, string $areaCode): ?string
    {
        return sprintf('/api/areas/%s', $this->getAreaByCodes($siteCode, $areaCode)->getId());
    }

    private function getAreaByCodes(string $siteCode, string $areaCode): ?Area
    {
        /** @var AreaRepository $repo */
        $repo = $this->getEntityRepository(Area::class);

        return $repo->findOneByCodes($siteCode, $areaCode);
    }
}
