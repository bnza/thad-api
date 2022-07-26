<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SUIsNotReferenced extends Constraint
{
    public string $message = 'This SU is still referenced in one of the following resource: stratigraphic sequence, stratigraphic relationship, pottery, cumulative pottery sheet, sample or small find and could not be deleted';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
