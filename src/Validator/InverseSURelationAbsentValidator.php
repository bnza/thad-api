<?php

namespace App\Validator;

use App\Entity\View\ViewStratigraphicRelationship;
use App\Repository\View\ViewStratigraphicRelationshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class InverseSURelationAbsentValidator extends ConstraintValidator
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function validate($protocol, Constraint $constraint)
    {
        if (!$constraint instanceof InverseSURelationAbsent) {
            throw new UnexpectedTypeException($constraint, InverseSURelationAbsent::class);
        }

        if (null === $protocol) {
            return;
        }

        if (!$protocol instanceof ViewStratigraphicRelationship) {
            throw new UnexpectedValueException($protocol, ViewStratigraphicRelationship::class);
        }
        /** @var ViewStratigraphicRelationshipRepository $repo */
        $repo = $this->entityManager->getRepository(ViewStratigraphicRelationship::class);
        if ($repo->inverseRelationExists($protocol->getSxSU(), $protocol->getDxSU())) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
