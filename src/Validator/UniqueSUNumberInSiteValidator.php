<?php

namespace App\Validator;

use App\Entity\SU;
use App\Repository\SURepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueSUNumberInSiteValidator extends ConstraintValidator
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @param SU $value
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueSUNumberInSite) {
            throw new UnexpectedTypeException($constraint, UniqueSUNumberInSite::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof SU) {
            throw new UnexpectedValueException($value, SU::class);
        }
        /** @var SURepository $repo */
        $repo = $this->entityManager->getRepository(SU::class);
        if ($repo->numberExistsInSite($value->getNumber(), $value->getArea())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ number }}', $value->getNumber())
                ->setParameter('{{ site }}', $value->getArea()->getSite()->getCode())
                ->addViolation();
        }
    }
}
