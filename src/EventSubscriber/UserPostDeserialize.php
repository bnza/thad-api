<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPostDeserialize implements EventSubscriberInterface
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private ValidatorInterface $validator
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
          KernelEvents::REQUEST => ['hashPassword', EventPriorities::POST_DESERIALIZE],
        ];
    }

    public function hashPassword(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $method = $event->getRequest()->getMethod();

        if (!$request->attributes->has('data')) {
            return;
        }

        $user = $request->attributes->get('data');

        if (!$user instanceof User || !in_array($method, [Request::METHOD_POST, Request::METHOD_PATCH])) {
            return;
        }
        $this->validator->validate($user, ['groups' => ['post:User:Validation']]);

        $user->setPassword($hashed = $this->passwordHasher->hashPassword($user, $user->getPassword()));
    }
}
