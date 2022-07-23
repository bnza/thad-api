<?php

namespace App\Validator;

use App\Entity\Site;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class SiteIsNotReferencedValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof SiteIsNotReferenced) {
            throw new UnexpectedTypeException($constraint, SiteIsNotReferenced::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof Site) {
            throw new UnexpectedValueException($value, Site::class);
        }

        if (
            (
                $value->getAreas()->count() ||
                $value->getStratigraphicUnits()->count() ||
                $value->graves->count() ||
                $value->documents->count()
            )
        ) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
