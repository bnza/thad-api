<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AuthApiTestCase extends ApiTestCase
{
    use RefreshDatabaseTrait;

    protected const USER_BASE = 'user_base@example.com';
    protected const USER_BASE_PW = '0000';
    protected const USER_EDITOR = 'user_editor@example.com';
    protected const USER_EDITOR_PW = '0001';
    protected const USER_ADMIN = 'user_admin@example.com';
    protected const USER_ADMIN_PW = '0002';

    protected HttpClientInterface $client;
    private string $jwtToken = '';

    protected function getClient(): HttpClientInterface
    {
        if (!isset($this->client)) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }

    protected function getEntityRepository(string $class): ServiceEntityRepositoryInterface
    {
        return self::getContainer()->get('doctrine')->getManager()->getRepository($class);
    }

    protected function authenticate(?string $username = self::USER_BASE, ?string $password = self::USER_BASE_PW, $throw = true): ResponseInterface
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

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    protected function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return $this->getClient()->request($method, $url, $this->setAuthenticationHeader($options));
    }

    protected function patchRequest(string $url, array $json): ResponseInterface
    {
        $options = $this->setContentTypeHeader('application/merge-patch+json',
            [
                'json' => $json,
            ]);

        return $this->request(
            'PATCH',
            $url,
            $options
        );
    }

    protected function setRequestAcceptHeader(string $accept, array $options = []): array
    {
        $options['headers']['Accept'] = $accept;

        return $options;
    }

    protected function setContentTypeHeader(string $contentType, array $options = []): array
    {
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }
        $options['headers']['Content-Type'] = $contentType;

        return $options;
    }

    protected function setPatchContentTypeHeader(array $options = []): array
    {
        return $this->setContentTypeHeader(' application/merge-patch+json', $options);
    }

    private function setAuthenticationHeader(array $options = []): array
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

    protected function getIdFromResponse(ResponseInterface $response): int
    {
        $content = json_decode($response->getContent(), true);
        return $content['id'];
    }
}
