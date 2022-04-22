<?php

namespace App\Tests\Functional;

use App\Entity\Area;
use App\Entity\SU;
use App\Repository\AreaRepository;

class SUResourceTest extends AuthApiTestCase
{
    protected function getBaseResourceIri(): string
    {
        return 'stratigraphic_units';
    }

    public function testUnauthenticatedGetCollection(): void
    {
        $response = $this->request(
            'GET',
            '/api/stratigraphic_units'
        );
        $this->assertResponseStatusCodeSame(401);
    }

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
        $this->markTestSkipped(
            'To do'
        );

        $this->adminPostCollectionRequest(
            SU::class,
            [
                'area' => $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                'number' => 10,
                'date' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    public function testPostValidateDuplicateNumberInSite(): void
    {
        $this->adminPostCollectionRequest(
            SU::class,
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
