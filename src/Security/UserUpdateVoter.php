<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class UserUpdateVoter extends Voter
{
    private const ATTRIBUTE = 'USER_UPDATE';

    public function __construct(
        private readonly Security $security,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly RequestStack $requestStack)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return self::ATTRIBUTE === $attribute && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN', $user)) {
            return $this->voteOnAdmin($subject, $user);
        }

        return $this->voteOnUser($subject, $user);
    }

    /**
     * Admin can't change his own role.
     */
    private function voteOnAdmin(User $requestUser, User $user): bool
    {
        $parameters = $this->getRequestParams();

        if ($user->getId() !== $requestUser->getId()) {
            // admin can change anything on other users
            return true;
        }

        if (!$parameters || array_key_exists('roles', $parameters)) {
            return false;
        }

        return true;
    }

    private function voteOnUser(User $requestUser, User $user): bool
    {
        if ($user->getId() !== $requestUser->getId()) {
            // updating user must match the current user; if not, deny access
            return false;
        }

        $parameters = $this->expectedRequestParams();

        if (!$parameters) {
            return false;
        }

        return $this->passwordMatch($user, $parameters);
    }

    private function getRequestParams(): ?array
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = json_decode($request->getContent(), true);

        if ($parameters && is_array($parameters)) {
            return $parameters;
        }

        return null;
    }

    /**
     * Current user can only change his password and MUST provide the old password.
     */
    private function expectedRequestParams(): ?array
    {
        $parameters = $this->getRequestParams();

        if ($parameters
            && 2 === count($parameters)
            && array_key_exists('oldPassword', $parameters)
            && array_key_exists('password', $parameters)
        ) {
            return $parameters;
        }

        return null;
    }

    private function passwordMatch(User $user, array $parameters): bool
    {
        return $this->passwordHasher->isPasswordValid($user, $parameters['oldPassword']);
    }
}
