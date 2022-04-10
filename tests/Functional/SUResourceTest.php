<?php

namespace App\Tests\Functional;

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
}
