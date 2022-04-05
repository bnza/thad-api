<?php

namespace App\Tests\Functional;

class LoginTest extends AuthApiTestCase
{
    public function testInvalidCredentialsRequest(): void
    {
        $response = $this->authenticate('wrong@example.com', 'wrong', false);
        $this->assertResponseStatusCodeSame(401);
        $this->assertJsonStringEqualsJsonString('{"code":401,"message":"Invalid credentials."}', $response->getContent(false));
    }

    public function testSuccessfulLoginRequest(): void
    {
        $response = $this->authenticate();
        $this->assertResponseIsSuccessful();
        $token = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('token', $token);
    }

    public function testAnonymousUserMeEndpoint(): void
    {
        $this->request('GET', '/api/users/me');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testAuthenticatedUserMeEndpoint(): void
    {
        $this->authenticate();
        $this->request('GET', '/api/users/me');

        $this->assertResponseIsSuccessful();
    }
}
