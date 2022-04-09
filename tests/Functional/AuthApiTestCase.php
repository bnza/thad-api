<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AuthApiTestCase extends ApiTestCase
{
    use RefreshDatabaseTrait;

    protected const BASE_USER = 'base_user@example.com';
    protected const BASE_USER_PW = '0000';

    protected HttpClientInterface $client;
    private string $jwtToken = '';

    protected function getClient(): HttpClientInterface
    {
        if (!isset($this->client)) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }

    protected function authenticate(?string $username = self::BASE_USER, ?string $password = self::BASE_USER_PW, $throw = true): ResponseInterface
    {
        $response = $this->getClient()->request('POST', '/api/login', [
            'json' => [
                'username' => $username,
                'password' => $password,
            ],
        ]);

        if ($response->getStatusCode() < 300) {
            $content = json_decode($response->getContent($throw), true);
            $this->jwtToken = $content['token'];
        }

        return $response;
    }

    protected function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return $this->getClient()->request($method, $url, $this->setAuthenticationHeader($options));
    }

    protected function setRequestAcceptHeader(string $contentType, array &$options = []): array
    {
        $options['headers']['Accept'] = $contentType;
        return $options;
    }

    private function setAuthenticationHeader(array &$options = []): array
    {
        if (!$this->jwtToken) {
            return $options;
        }
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }
        $options['headers']['Authorization'] = "Bearer $this->jwtToken";

        return $options;
    }
}
