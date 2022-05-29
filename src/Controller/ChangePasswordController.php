<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class ChangePasswordController extends AbstractController
{
    public function __construct(
        private readonly Security $security,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $repository
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $currentUser = $this->security->getUser();

        if (!$currentUser) {
            return new JWTAuthenticationFailureResponse();
        }

        $user = $this->repository->findOneByEmail($currentUser->getUserIdentifier());

        if (!$user) {
            return new JWTAuthenticationFailureResponse();
        }

        $body = json_decode($request->getContent(), true);

        if (
            !array_key_exists('oldPassword', $body)
        ) {
            throw new UnprocessableEntityHttpException('Old password is required');
        }

        $oldPassword = $body['oldPassword'];

        if (!$this->passwordHasher->isPasswordValid($user, $oldPassword)) {
            return new JWTAuthenticationFailureResponse();
        }

        if (
            !array_key_exists('newPassword', $body)
        ) {
            throw new UnprocessableEntityHttpException('New password is required');
        }

        $newPassword = $body['newPassword'];

        if (
            !array_key_exists('repeatPassword', $body)
        ) {
            throw new UnprocessableEntityHttpException('Repeat password is required');
        }

        $repeatPassword = $body['repeatPassword'];

        if ($newPassword !== $repeatPassword) {
            throw new UnprocessableEntityHttpException('Passwords do not match');
        }
        $this->repository->upgradePassword($user, $this->passwordHasher->hashPassword($user, $newPassword));

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
