<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AuthApiTestCase extends ApiTestCase
{
    use RefreshDatabaseTrait;

    private const BASE_USER = 'base_user@example.com';
    private const BASE_USER_PW = '0000';

    protected HttpClientInterface $client;

    protected function authenticate(?string $username = self::BASE_USER, ?string $password = self::BASE_USER_PW): ResponseInterface
    {
        if (!isset($this->client)) {
            $this->client = $this->createClient();
        }
        return $this->client->request('POST', '/api/login', [
            'json' => [
                'username' => $username,
                'password' => $password,
            ],
        ]);
    }
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function getToken(?string $username, ?string $password): string
    {
        return $this->authenticate($username, $password)->getContent();
    }
}
