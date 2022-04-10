<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
        $password = '12345aA!';
        $this->addUser($username, $password);
        $this->authenticate($username, $password);
        $this->assertResponseIsSuccessful();
    }

    public function testDeleteWithAdminUser(): void
    {
        $username = 'new2@example.com';
        $password = '12345aA!';

        $newUser = $this->addUser($username, $password);
        $this->request(
            'DELETE',
            '/api/users/'.$newUser->getId(),
        );
    }

    public function testPatchWithAdminUser(): void
    {
        $username = 'new2@example.com';
        $password = '12345aA!';
        $newPassword = '12345aB!';
        $newUser = $this->addUser($username, $password);

        $this->patchRequest(
            sprintf('/api/users/%s', $newUser->getId()),
            [
                'password' => $newPassword,
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->authenticate($username, $newPassword);
        $this->assertResponseIsSuccessful();
    }

    private function addUser(string $username, string $password): User
    {
        $this->addUserRequest($username, $password);
        $this->assertResponseIsSuccessful();

        return $this->getEntityRepository(User::class)->findOneByEmail($username);
    }

    private function addUserRequest(string $username, string $password, array $roles = []): ResponseInterface
    {
        $this->authenticate(self::USER_ADMIN, self::USER_ADMIN_PW);

        return $this->request(
            'POST',
            '/api/users',
            [
                'json' => [
                    'email' => $username,
                    'password' => $password,
                    'roles' => $roles,
                ],
            ]
        );
    }

    public function invalidUserDataProvider(): array
    {
        return [
            'invalidEmail' => ['examle@example', 'somePassword'],
            'emptyPassword' => ['example@example.com', ''],
            'shortPassword' => ['example@example.com', '1234567'],
            'noDigitPassword' => ['example@example.com', 'aaaaaaaa'],
            'noUppercasePassword' => ['example@example.com', '1234567a'],
            'noLowercasePassword' => ['example@example.com', '1234567A'],
            'alphanumericPassword' => ['example@example.com', '123456aA'],
            'invalidRole' => ['example@example.com', '123456aA', ['WRONG_ROLE']],
            'oneInvalidRole' => ['example@example.com', '123456aA', ['ROLE_USER', 'WRONG_ROLE']],
            'oneNonStringRole' => ['example@example.com', '123456aA', ['ROLE_USER', 0]],
            'oneBlankRole' => ['example@example.com', '123456aA', ['ROLE_USER', '']],
        ];
    }

    /**
     * @dataProvider invalidUserDataProvider
     */
    public function testValidation($username, $password, $roles = []): void
    {
        $this->addUserRequest($username, $password, $roles);
        $this->assertResponseStatusCodeSame(422);
    }

    public function itemOperationsAuthDeniedProvider()
    {
        /** @var UserRepository $repo */
        $repo = $this->getEntityRepository(User::class);
        $baseUser = $repo->findOneByEmail(self::USER_BASE);
        $editorUser = $repo->findOneByEmail(self::USER_EDITOR);

        return [
            ['GET', self::USER_BASE, self::USER_BASE_PW, '/api/users/'.$editorUser->getId()],
            ['DELETE', self::USER_BASE, self::USER_BASE_PW, '/api/users/'.$editorUser->getId()],
            ['PATCH', self::USER_BASE, self::USER_BASE_PW, '/api/users/'.$editorUser->getId()],
            ['GET', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/users/'.$baseUser->getId()],
            ['DELETE', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/users/'.$baseUser->getId()],
            ['PATCH', self::USER_EDITOR, self::USER_EDITOR_PW, '/api/users/'.$baseUser->getId()],
        ];
    }

    /**
     * @dataProvider itemOperationsAuthDeniedProvider
     */
    public function testItemOperationsAuthDenied($method, $username, $password, $url): void
    {
        $this->authenticate($username, $password);
        $this->assertResponseIsSuccessful();

        $this->request(
            $method,
            $url,
            [
                'json' => [
                    'email' => $username,
                    'password' => $password,
                ],
            ]
            );
        $this->assertResponseStatusCodeSame(403);
    }
}
