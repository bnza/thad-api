<?php

namespace App\Validator;

#[\Attribute]
class InverseSURelationAbsent
{
    public string $message = 'Stratigraphic relationship between given SUs already exists';
}
