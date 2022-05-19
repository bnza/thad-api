<?php

namespace App\Tests\Functional;

use App\Entity\Area;
use App\Entity\SU;
use App\Entity\Vocabulary\SU\Type;
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
        $this->adminPostCollectionRequest(
            SU::class,
            [
                'area' => $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                'number' => 10,
                'date' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                'year' => 2022,
                'type' => $this->getVocabularyIriByValue(Type::class, 'cut'),
            ]
        );
        $this->assertResponseStatusCodeSame(201);
    }

    public function invalidSuDataProvider(): array
    {
        return [];
        /*            'blankArea' => [
                        null,
                        234,
                        (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                        2022,
                        $this->getVocabularyIriByValue(Type::class, 'filling'),
                    ],
                    'blankNumber' => [
                        $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                        null,
                        (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                        2022,
                        $this->getVocabularyIriByValue(Type::class, 'filling'),
                    ],
                    'duplicateNumber' => [
                        $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                        1,
                        (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                        2022,
                        $this->getVocabularyIriByValue(Type::class, 'filling'),
                    ],
                    'blankDate' => [
                        $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                        234,
                        null,
                        2022,
                        $this->getVocabularyIriByValue(Type::class, 'filling'),
                    ],
                    'blankType' => [
                        $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                        234,
                        (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                        2022,
                        null,
                    ],
                    'blankYear' => [
                        $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                        234,
                        (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                        null,
                        $this->getVocabularyIriByValue(Type::class, 'filling'),
                    ],*/
    }

    /**
     * @group wip
     * @dataProvider invalidSuDataProvider
     */
    public function testValidation($area, $number, $date, $year, $type, $square = null)
    {
        $this->markTestSkipped('must be revisited.');
        $this->adminPostCollectionRequest(
            SU::class,
            [
                'area' => $area,
                'number' => $number,
                'date' => $date,
                'year' => $year,
                'type' => $type,
            ]
        );
        $this->assertResponseStatusCodeSame(422);
    }

    public function testPostValidateDuplicateNumberInSite(): void
    {
        $this->adminPostCollectionRequest(
            SU::class,
            [
                'area' => $this->getAreaResourceIdentifierByCodes('TH', 'A'),
                'number' => 1,
                'date' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                'year' => 2022,
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
