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
     * @param SmallFind $protocol
     */
    public function validate($protocol, Constraint $constraint)
    {
        if (!$constraint instanceof CoordinateIsATriple) {
            throw new UnexpectedTypeException($constraint, CoordinateIsATriple::class);
        }

        if (null === $protocol) {
            return;
        }

        if (!$protocol instanceof SmallFind) {
            throw new UnexpectedValueException($protocol, SmallFind::class);
        }

        if (!$protocol->coordE && !$protocol->coordN && !$protocol->coordZ) {
            return;
        }

        if ($protocol->coordE && $protocol->coordN && $protocol->coordZ) {
            return;
        }

        $this->context->buildViolation($constraint->message)->addViolation();
    }
}
