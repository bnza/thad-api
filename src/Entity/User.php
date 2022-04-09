<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MeController;
use App\Validator as AppAssert;
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
    ],
    itemOperations: [
        'get' => null,
        'patch' => null,
        'delete' => null,
    ],
    denormalizationContext: [
        'write:User',
        'change_password:User',
    ],
    normalizationContext: [
        'groups' => [
            'read:User',
        ],
    ],
    security: 'is_granted("ROLE_ADMIN")'
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups(['read:User'])]
    private Uuid $id;

    #[Assert\Email]
    #[Groups(['read:User', 'write:User'])]
    private string $email;

    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type(type: 'string'),
        new AppAssert\IsValidRoles(),
       ])]
    #[Groups(['read:User', 'write:User'])]
    private array $roles = [];

    #[Assert\NotBlank(groups: ['write:User'])]
    #[Assert\Length(min: 8, groups: ['write:User'])]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Your password must contains at lest one digit',
        groups: ['write:User']
    )]
    #[Assert\Regex(
        pattern: '/[A-Z]+/',
        message: 'Your password must contains at lest one uppercase character',
        groups: ['write:User']
    )]
    #[Assert\Regex(
        pattern: '/[a-z]+/',
        message: 'Your password must contains at lest one lowercase character',
        groups: ['write:User']
    )]
    #[Assert\Regex(
        pattern: '/\W/',
        message: 'Your password must contains at lest one not alphanumeric character',
        groups: ['write:User']
    )]
    #[Groups(['write:User', 'change_password:User'])]
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

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
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
