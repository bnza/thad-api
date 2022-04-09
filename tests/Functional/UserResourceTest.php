<?php

namespace App\Tests\Functional;

use App\Entity\User;

class UserResourceTest extends AuthApiTestCase
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
        $this->request(
            'GET',
            '/api/users/me',
            $this->setRequestAcceptHeader('application/json')
        );
        $this->assertResponseStatusCodeSame(401);
    }

    public function testAuthenticatedUserMeEndpoint(): void
    {
        $this->authenticate();
        $this->request(
            'GET',
            '/api/users/me',
            $this->setRequestAcceptHeader('application/json')
        );
        $this->assertResponseIsSuccessful();
    }

    public function testPostWithAdminUser(): void
    {
        $username = 'new@example.com';
        $password = '0004';
        $newUser = $this->addUser($username, $password);
        $this->authenticate($username, $password);
        $this->assertResponseIsSuccessful();
    }

    public function testPatchWithAdminUser(): void
    {
        $username = 'new2@example.com';
        $password = '0004';
        $newUser = $this->addUser($username, $password);

        $options = $this->setContentTypeHeader('application/merge-patch+json',
            [
                'json' => [
                    'password' => '0005',
                ],
            ]);
        $this->request(
            'PATCH',
            '/api/users/'.$newUser->getId(),
            $options
        );
        $this->assertResponseIsSuccessful();
        $this->authenticate($username, '0005');
        $this->assertResponseIsSuccessful();
    }

    private function addUser(string $username, $password): User
    {
        $this->authenticate(self::USER_ADMIN, self::USER_ADMIN_PW);
        $this->request(
            'POST',
            '/api/users',
            [
                'json' => [
                    'email' => $username,
                    'password' => $password,
                ],
            ]
        );
        $this->assertResponseIsSuccessful();

        return $this->getEntityRepository(User::class)->findOneByEmail($username);
    }
}
