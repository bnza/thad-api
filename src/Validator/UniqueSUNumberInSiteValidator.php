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
     * @param SU $protocol
     */
    public function validate($protocol, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueSUNumberInSite) {
            throw new UnexpectedTypeException($constraint, UniqueSUNumberInSite::class);
        }

        if (null === $protocol) {
            return;
        }

        if (!$protocol instanceof SU) {
            throw new UnexpectedValueException($protocol, SU::class);
        }
        /** @var SURepository $repo */
        $repo = $this->entityManager->getRepository(SU::class);
        if ($repo->numberExistsInSite($protocol->getNumber(), $protocol->getArea())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ number }}', $protocol->getNumber())
                ->setParameter('{{ site }}', $protocol->getArea()->getSite()->getCode())
                ->addViolation();
        }
    }
}
