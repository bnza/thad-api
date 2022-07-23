<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class AreaIsNotReferenced extends Constraint
{
    public string $message = 'This area is still referenced in one of the following resource: SU, grave or document and could not be deleted';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
