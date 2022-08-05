<?php

namespace App\Validator;

use App\Entity\View\ViewStratigraphicRelationship;
use App\Entity\View\ViewStratigraphicSequence;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class SURelationshipIsNotSelfReferencingValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof SURelationshipIsNotSelfReferencing) {
            throw new UnexpectedTypeException($constraint, SURelationshipIsNotSelfReferencing::class);
        }

        if (null === $value) {
            return;
        }

        if (
            !$value instanceof ViewStratigraphicRelationship &&
            !$value instanceof ViewStratigraphicSequence
        ) {
            throw new UnexpectedValueException($value, ViewStratigraphicRelationship::class.' or '.ViewStratigraphicSequence::class);
        }

        if (!$value->dxSU && !$value->sxSU) {
            return;
        }

        if ($value->dxSU->getId() === $value->sxSU->getId()) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
