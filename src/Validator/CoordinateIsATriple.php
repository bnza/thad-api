<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CoordinateIsATriple extends Constraint
{
    public string $message = 'Coordinate must have all the N, E, Z components';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
