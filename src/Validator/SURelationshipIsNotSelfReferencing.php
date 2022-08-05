<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SURelationshipIsNotSelfReferencing extends Constraint
{
    public string $message = 'Stratigraphic relationship/sequence should not self referencing';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
