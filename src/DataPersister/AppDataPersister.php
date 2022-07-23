<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;

final class AppDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private readonly ContextAwareDataPersisterInterface $decorated,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        return $this->decorated->persist($data, $context);
    }

    public function remove($data, array $context = [])
    {
        $this->validator->validate($data, ['groups' => 'Delete']);
        return $this->decorated->remove($data, $context);
    }
}
