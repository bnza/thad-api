<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Controller\MeController;
use App\Validator as AppAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'me' => [
            'controller' => MeController::class,
            'formats' => [
                'json' => ['application/json'],
            ],
            'method' => 'GET',
            'openapi_context' => [
                'responses' => [
                    '200' => [
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User-read.User',
                                ],
                            ],
                        ],
                        'description' => 'Current user.',
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
                'summary' => 'Retrieves the information about the current user.',
            ],
            'pagination_enabled' => false,
            'path' => '/users/me',
            'security' => 'is_granted("ROLE_USER")',
        ],
        'get',
    ],
    itemOperations: [
        'get',
        'patch' => [
            'security' => "is_granted('USER_UPDATE', object)",
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'anyOf' => [
                                    ['$ref' => '#/components/schemas/ChangePasswordData'],
                                    ['$ref' => '#/components/schemas/UpdateUser'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'denormalizationContext' => [
                'groups' => [
                    'update:User',
                ],
            ],
        ],
        'delete' => [
            'security' => "is_granted('USER_DELETE', object)",
        ],
    ],
    attributes: [
        'validation_groups' => ['post:User:Validation'],
    ],
    denormalizationContext: [
        'groups' => [
            'write:User',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:User',
        ],
    ],
    security: 'is_granted("ROLE_ADMIN")'
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'email',
        'roles',
    ]
)]
#[UniqueEntity(
    fields: ['email'],
    message: 'Duplicate username.',
    errorPath: 'email',
    groups: ['post:User:Validation']
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups(['read:User'])]
    private Uuid $id;

    #[Assert\Email(
        groups: ['post:User:Validation']
    )]
    #[Groups(['read:User', 'write:User'])]
    private string $email;

    #[Assert\NotBlank(
        groups: ['post:User:Validation']
    )]
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type(type: 'string'),
        new AppAssert\IsValidRoles(),
        ],
        groups: ['post:User:Validation']
    )]
    #[Groups(['read:User', 'write:User', 'update:User'])]
    private array $roles = ['ROLE_USER'];

    #[Assert\NotBlank(
        groups: ['post:User:Validation']
    )]
    #[Assert\Length(min: 8, groups: ['post:User:Validation'])]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Your password must contains at lest one digit',
        groups: ['post:User:Validation']
    )]
    #[Assert\Regex(
        pattern: '/[A-Z]+/',
        message: 'Your password must contains at lest one uppercase character',
        groups: ['write:User']
    )]
    #[Assert\Regex(
        pattern: '/[a-z]+/',
        message: 'Your password must contains at lest one lowercase character',
        groups: ['post:User:Validation']
    )]
    #[Assert\Regex(
        pattern: '/\W/',
        message: 'Your password must contains at lest one not alphanumeric character',
        groups: ['post:User:Validation']
    )]
   #[Groups(['write:User', 'update:User'])]
    private string $password;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        if (in_array('ROLE_ADMIN', $roles)) {
            $roles[] = 'ROLE_EDITOR';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        asort($roles);
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
