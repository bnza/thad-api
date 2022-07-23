<?php

namespace App\Validator;

use App\Entity\Area;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class AreaIsNotReferencedValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof AreaIsNotReferenced) {
            throw new UnexpectedTypeException($constraint, AreaIsNotReferenced::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof Area) {
            throw new UnexpectedValueException($value, Area::class);
        }

        if (
            (
                $value->getStratigraphicUnits()->count() ||
                $value->graves->count() ||
                $value->documents->count()
            )
        ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
