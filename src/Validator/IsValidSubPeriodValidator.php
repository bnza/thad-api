<?php

namespace App\Validator;

use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\Subperiod;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class IsValidSubPeriodValidator extends ConstraintValidator
{
    public function __construct(
        private readonly PropertyAccessorInterface $propertyAccessor
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof IsValidSubPeriod) {
            throw new UnexpectedTypeException($constraint, IsValidSubPeriod::class);
        }

        if (null === $value) {
            return;
        }

        /** @var Subperiod */
        $subperiod = $this->propertyAccessor->getValue($value, 'subperiod');

        if (!$subperiod) {
            return;
        }

        /** @var Period $period */
        $period = $this->propertyAccessor->getValue($value, 'period');

        if ($period && $subperiod->period->getId() !== $period->getId()) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
