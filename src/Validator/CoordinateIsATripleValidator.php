<?php

namespace App\Validator;

use App\Entity\SmallFind;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class CoordinateIsATripleValidator extends ConstraintValidator
{
    /**
     * @param SmallFind $value
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CoordinateIsATriple) {
            throw new UnexpectedTypeException($constraint, CoordinateIsATriple::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof SmallFind) {
            throw new UnexpectedValueException($value, SmallFind::class);
        }

        if (!$value->coordE && !$value->coordN && !$value->coordZ) {
            return;
        }

        if ($value->coordE && $value->coordN && $value->coordZ) {
            return;
        }

        $this->context->buildViolation($constraint->message)->addViolation();
    }
}
