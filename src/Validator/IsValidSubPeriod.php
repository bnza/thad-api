<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidSubPeriod extends Constraint
{
    public string $message = 'Period/subperiod mismatch';

    public function getTargets(): array|string
    {
        return self::CLASS_CONSTRAINT;
    }
}
