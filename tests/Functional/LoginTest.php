<?php

namespace App\Tests\Functional;

class LoginTest extends AuthApiTestCase
{
    public function testInvalidCredentialsRequest(): void
    {
        $response = $this->authenticate('wrong@example.com', 'wrong');
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
}
