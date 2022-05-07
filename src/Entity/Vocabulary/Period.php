<?php

namespace App\Entity\Vocabulary;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => null,
    ],
    itemOperations: [
        'get' => null,
    ],
    routePrefix: 'vocabulary',
)]
class Period
{
    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SU',
    ])]
    private int $id;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SU',
    ])]
    private ?Period $parent;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SU',
    ])]
    private string $code;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SU',
    ])]
    private string $value;

    private iterable $subPeriods;

    #[Groups([
        'read:Area',
        'read:Pottery',
        'read:SU',
    ])]
    private ?string $description;

    public function __construct()
    {
        $this->subPeriods = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Period
    {
        $this->id = $id;

        return $this;
    }

    public function getParent(): ?Period
    {
        return $this->parent;
    }

    public function setParent(?Period $parent): Period
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Period
    {
        $this->code = $code;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): Period
    {
        $this->value = $value;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Period
    {
        $this->description = $description;

        return $this;
    }

    public function getSubPeriods(): iterable|ArrayCollection
    {
        return $this->subPeriods;
    }

    public function setSubPeriods(iterable|ArrayCollection $subPeriods): Period
    {
        $this->subPeriods = $subPeriods;

        return $this;
    }
}
