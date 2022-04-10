<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueSUNumberInSite extends Constraint
{
    public string $message = 'Duplicate SU number [{{ number }}] in site "{{ site }}"';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
