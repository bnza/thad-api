<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    private OpenApi $openApi;

    public function __construct(private OpenApiFactoryInterface $decorated)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $this->openApi = $this->decorated->__invoke($context);
        $this->setSchemas();
        $this->setLoginPath();
        $this->setRefreshTokenPath();
        $this->setInvalidateTokenPath();

        return $this->openApi;
    }

    private function setSchemas(): void
    {
        $schemas = $this->openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'example' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTczNTg2NzksImV4cCI6MTY1NzM2MjI3OSwicm9sZXMiOlsiUk9MRV9BRE1JTiIsIlJPTEVfVVNFUiIsIlJPTEVfRURJVE9SIl0sImVtYWlsIjoidXNlcl9hZG1pbkBleGFtcGxlLmNvbSJ9.Dfvy7WtqeKl79bK74D8-eIZ04XHFbSGK3bDMZ3nlP7oNu1B81X1Cg0qwRPrpicbzbqWzy19Vo1fPK13cTW5jqIO-s_hDYdbH-lMZqqu-RUodSME6L7Q0SW2JPTNVqmfw4-kKEV-fDyifyfuqxe2-wF86MKGc4eKzu0ILBtkDV7aOpiW9dfdxmT_hisNN9QrwnHN0VsuyzqTnmTBVAo8uBS_audCqX3-63mGeuUrFX7DaxQWwvXWfUYjbL5U5pI9OZWKFkEjx7UYSNwwb5Etf6cWHClbg_PqACz0IgORQjcri42RhJiNz3NhikkzAMH5mo0ClCA8NzweF9_Q6nITcXX',
                ],
                'refresh_token' => [
                    'type' => 'string',
                    'example' => 'b75401beb51b29913147c51a355552f5eea2275890f63fde101e30e6407c7c9ec700792cecd1eb0de4e46010e321644d2b56a08b3721fe8c6de6c71ca40144QQ',
                ],
            ],
        ]);

        $schemas['RefreshToken'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'refresh_token' => [
                    'type' => 'string',
                    'example' => 'b75401beb51b29913147c51a355552f5eea2275890f63fde101e30e6407c7c9ec700792cecd1eb0de4e46010e321644d2b56a08b3721fe8c6de6c71ca40144QQ',
                ],
            ],
        ]);

        $schemas['RefreshTokenInvalidate'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'message' => [
                    'type' => 'string',
                    'example' => 'The supplied refresh_token has been invalidated.',
                ],
            ],
        ]);

        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'user@example.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'somePassword',
                ],
            ],
        ]);

        $schemas['ChangePasswordData'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'oldPassword' => [
                    'type' => 'string',
                    'example' => 'somePassword',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'somePassword',
                ],
            ],
        ]);

        $schemas['Roles'] = new \ArrayObject([
            'type' => 'array',
            'items' => [
                'type' => 'string',
                'enum' => ['ROLE_USER', 'ROLE_EDITOR', 'ROLE_ADMIN'],
            ],
        ]);

        $schemas['UpdateUser'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'password' => [
                    'type' => 'string',
                    'example' => 'somePassword',
                ],
                'roles' => [
                    '$ref' => '#/components/schemas/Roles',
                    'example' => ['ROLE_USER'],
                ],
            ],
        ]);

        $schemas['SecurityError'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'code' => [
                    'type' => 'number',
                    'example' => 401,
                ],
                'error' => [
                    'type' => 'string',
                    'example' => 'Invalid credentials.',
                ],
            ],
        ]);
    }

    private function setLoginPath()
    {
        $loginPathItem = new PathItem(
            post: new Operation(
                operationId: 'loginId',
                responses: [
                    '200' => [
                        'description' => 'User token refreshed',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token',
                                ],
                            ],
                        ],
                    ],
                    '401' => [
                        'description' => 'Security issue',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/SecurityError',
                                ],
                            ],
                        ],
                    ],
                ],
                requestBody: new RequestBody(
                    description: 'loginId',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials',
                            ],
                        ],
                    ]))
            )
        );
        $this->openApi->getPaths()->addPath('/api/login', $loginPathItem);
    }

    private function setRefreshTokenPath()
    {
        $refreshTokenPathItem = new PathItem(
            post: new Operation(
                operationId: 'refreshTokenId',
                responses: [
                    '200' => [
                        'description' => 'User logged in',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token',
                                ],
                            ],
                        ],
                    ],
                    '401' => [
                        'description' => 'Security issue',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/SecurityError',
                                ],
                            ],
                        ],
                    ],
                ],
                requestBody: new RequestBody(
                    description: 'refreshTokenId',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RefreshToken',
                            ],
                        ],
                    ]))
            )
        );
        $this->openApi->getPaths()->addPath('/api/token/refresh', $refreshTokenPathItem);
    }

    private function setInvalidateTokenPath()
    {
        $invalidateTokenPathItem = new PathItem(
            post: new Operation(
                operationId: 'invalidateTokenId',
                responses: [
                    '200' => [
                        'description' => 'User token invalidate',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/RefreshTokenInvalidate',
                                ],
                            ],
                        ],
                    ],
                    '400' => [
                        'description' => 'Security issue',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/SecurityError',
                                ],
                            ],
                        ],
                    ],
                ],
                requestBody: new RequestBody(
                    description: 'invalidateTokenId',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RefreshToken',
                            ],
                        ],
                    ]))
            )
        );
        $this->openApi->getPaths()->addPath('/api/token/invalidate', $invalidateTokenPathItem);
    }
}
