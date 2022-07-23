<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidSubPeriod extends Constraint
{
    public string $message = 'Period/subperiod mismatch';

    public function __construct(
        $options = null,
        array $groups = [],
        $payload = null,
        public readonly string $periodField = 'period',
        public readonly string $subPeriodField = 'subperiod')
    {
        parent::__construct($options, $groups, $payload);
    }

    public function getTargets(): array|string
    {
        return self::CLASS_CONSTRAINT;
    }
}
