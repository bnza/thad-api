<?php

namespace App\Validator;

use App\Entity\SU;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class SUIsNotReferencedValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof SUIsNotReferenced) {
            throw new UnexpectedTypeException($constraint, IsValidSubPeriod::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof SU) {
            throw new UnexpectedValueException($value, SU::class);
        }

        if (
            (
                $value->getPotteries()->count() ||
                $value->getEcofacts()->count() ||
                $value->getSmallFinds()->count() ||
                $value->getSamples()->count() ||
                $value->cumulativePotterySheet
            )
        ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
