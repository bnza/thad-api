<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SiteIsNotReferenced extends Constraint
{
    public string $message = 'This site is still referenced in one of the following resource: area, SU, grave or document and could not be deleted';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
