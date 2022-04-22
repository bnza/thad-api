<?php

namespace App\Tests\Functional;

use App\Entity\StratigraphicRelationship;
use App\Entity\SU;
use App\Entity\Vocabulary\SU\Relationship;

class StratigraphicRelationshipResourceTest extends AuthApiTestCase
{

    public function testUnauthenticatedGetCollection(): void
    {
        $response = $this->request(
            'GET',
            '/api/stratigraphic_relationships'
        );
        $this->assertResponseStatusCodeSame(401);
    }

    public function testGetCollection(): void
    {
        $this->authenticate();
        $response = $this->request(
            'GET',
            '/api/stratigraphic_relationships'
        );
        $this->assertResponseIsSuccessful();
    }

    /**
     * @group wip
     */
    public function testResourceLifeCycleWithAdminUser(): void
    {
        $response = $this->adminPostCollectionRequest(
            StratigraphicRelationship::class,
            [
            'sxSU' => $this->getResourceIriByCode(SU::class, 'TH.01'),
            'dxSU' => $this->getResourceIriByCode(SU::class, 'TH.004'),
            'relationship' => $this->getResourceIri(Relationship::class, 'a'),
        ]);
        $this->assertResponseStatusCodeSame(201);
        $content = json_decode($response->getContent(), true);
        $iri = $content['@id'];
        $id = $content['id'];
        $this->request(
            'GET',
            $iri
        );
        $this->assertResponseStatusCodeSame(200);
        $this->request(
            'GET',
            $this->getResourceIri(StratigraphicRelationship::class, $id * -1)
        );
        $this->assertResponseStatusCodeSame(200);
        $this->request(
            'DELETE',
            $this->getResourceIri(StratigraphicRelationship::class, $id * -1)
        );
        $this->assertResponseStatusCodeSame(204);
    }

    public function testPostValidateDuplicateNumberInSite(): void
    {
        $response = $this->adminPostCollectionRequest(
            StratigraphicRelationship::class,
            [
                'sxSU' => $this->getResourceIriByCode(SU::class, 'TH.01'),
                'dxSU' => $this->getResourceIriByCode(SU::class, 'TH.004'),
                'relationship' => $this->getResourceIri(Relationship::class, 'a'),
            ]);
        $this->assertResponseStatusCodeSame(201);
        $content = json_decode($response->getContent(), true);
        $iri = $content['@id'];
        $this->adminPostCollectionRequest(
            StratigraphicRelationship::class,
            [
                'sxSU' => $this->getResourceIriByCode(SU::class, 'TH.01'),
                'dxSU' => $this->getResourceIriByCode(SU::class, 'TH.004'),
                'relationship' => $this->getResourceIri(Relationship::class, 'a'),
            ]);
        $this->assertResponseStatusCodeSame(422);
        $this->adminPostCollectionRequest(
            StratigraphicRelationship::class,
            [
                'sxSU' => $this->getResourceIriByCode(SU::class, 'TH.04'),
                'dxSU' => $this->getResourceIriByCode(SU::class, 'TH.001'),
                'relationship' => $this->getResourceIri(Relationship::class, 'a'),
            ]);
        $this->assertResponseStatusCodeSame(422);
        $this->request(
            'DELETE',
            $iri
        );
        $this->assertResponseStatusCodeSame(204);
    }

}
