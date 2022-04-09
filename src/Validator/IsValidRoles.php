<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidRoles extends Constraint
{
    public string $message = 'The roles array contains invalid roles: {{  string }}';
}
