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
//        $this->setSecuritySchemes();
        $this->setSchemas();
        $this->setLoginPath();
        $this->setChangePasswordPath();

        return $this->openApi;
    }

//    private function setSecuritySchemes(): void
//    {
//        $securitySchemes = $this->openApi->getComponents()->getSecuritySchemes();
//        $securitySchemes['bearerAuth'] = new \ArrayObject([
//                'type' => 'http',
//                'scheme' => 'bearer',
//                'bearerFormat' => 'JWT',
//            ]);
//    }

    private function setSchemas(): void
    {
        $schemas = $this->openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
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
                'newPassword' => [
                    'type' => 'string',
                    'example' => 'somePassword',
                ],
                'repeatPassword' => [
                    'type' => 'string',
                    'example' => 'somePassword',
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

    private function setChangePasswordPath()
    {
        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'changePasswordId',
                responses: [
                    '204' => [
                        'description' => 'Successfully updated current user password.',
                    ],
                    '401' => [
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/SecurityError',
                                ],
                            ],
                        ],
                        'description' => 'Security issue.',
                    ],
                ],
                description: 'Change the current user password',
                requestBody: new RequestBody(
                    description: 'Change password data',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/ChangePasswordData',
                            ],
                        ],
                    ])
                ),
            )
        );
        $this->openApi->getPaths()->addPath('/api/me/change-password', $pathItem);
    }
}
