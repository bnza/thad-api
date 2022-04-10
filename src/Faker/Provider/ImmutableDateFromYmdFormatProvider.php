<?php

namespace App\Faker\Provider;

use App\Entity\User;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ImmutableDateFromYmdFormatProvider extends BaseProvider
{
    public function createImmutableDate(string $dateYmd): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d', $dateYmd);
    }
}
