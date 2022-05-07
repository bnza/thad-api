<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Vocabulary\Period;
use App\Entity\Vocabulary\Pottery\BaseShape;
use App\Entity\Vocabulary\Pottery\Body;
use App\Entity\Vocabulary\Pottery\Colour;
use App\Entity\Vocabulary\Pottery\Decoration;
use App\Entity\Vocabulary\Pottery\Fabric;
use App\Entity\Vocabulary\Pottery\Firing;
use App\Entity\Vocabulary\Pottery\Handle;
use App\Entity\Vocabulary\Pottery\ManufacturingTechnique;
use App\Entity\Vocabulary\Pottery\Neck;
use App\Entity\Vocabulary\Pottery\NeckLength;
use App\Entity\Vocabulary\Pottery\Preservation;
use App\Entity\Vocabulary\Pottery\RimCharacterization;
use App\Entity\Vocabulary\Pottery\RimDirection;
use App\Entity\Vocabulary\Pottery\RimShape;
use App\Entity\Vocabulary\Pottery\SizeGroup;
use App\Entity\Vocabulary\Pottery\Spout;
use App\Entity\Vocabulary\Pottery\SurfaceCharacteristic;
use App\Entity\Vocabulary\Pottery\SurfaceTreatment;
use App\Entity\Vocabulary\Pottery\VesselShape;
use App\Entity\Vocabulary\Pottery\Ware;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'post' => null,
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'patch' => null,
        'delete' => null,
    ],
    denormalizationContext: [
        'groups' => [
            'write:Pottery',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:Pottery',
        ],
    ],
    security: 'is_granted("ROLE_EDITOR")'
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'stratigraphicUnit.id' => 'exact',
        'stratigraphicUnit.site.id' => 'exact',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'stratigraphicUnit.area.code',
        'stratigraphicUnit.site.code',
        'stratigraphicUnit.number',
        'number',
        'ware.value',
        'fabric.value',
        'externalSurfaceColour.value',
        'internalSurfaceColour.value',
        'surfaceCharacteristic.value',
        'surfaceTreatment.value',
        'fractureColour.value',
        'manufacturingTechnique.value',
        'firing.value',
        'decoration.value',
        'vesselShape.value',
        'rimShape.value',
        'baselShape.value',
        'rimDirection.value',
        'rimCharacterization.value',
        'neck.value',
        'neckLength.value',
        'body.value',
        'spout.value',
        'handle.value',
        'sizeGroup.value',
        'preservation.value',
        'thickness',
        'rimDiameter',
        'baseDiameter',
        'compiler',
        'date',
        'note',
    ]
)]
#[UniqueEntity(
    fields: ['stratigraphicUnit', 'number'],
    message: 'pottery number {{ value }} already exists in this SU',
    errorPath: 'number',
)]
class Pottery
{
    #[Groups([
        'read:Pottery',
    ])]
    private int $id;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private SU $stratigraphicUnit;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private int $number;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?float $thickness;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?float $rimDiameter;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?float $baseDiameter;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?string $compiler;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?string $notes;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Period $period;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Colour $externalSurfaceColour;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Colour $internalSurfaceColour;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Colour $fractureColour;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Ware $ware;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Fabric $fabric;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?SurfaceCharacteristic $surfaceCharacteristic;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?SurfaceTreatment $surfaceTreatment;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?ManufacturingTechnique $manufacturingTechnique;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Firing $firing;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Decoration $decoration;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?VesselShape $vesselShape;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?RimShape $rimShape;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?RimDirection $rimDirection;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?RimCharacterization $rimCharacterization;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Neck $neck;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?NeckLength $neckLength;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Body $body;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Spout $spout;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Handle $handle;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?BaseShape $baseShape;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?SizeGroup $sizeGroup;

    #[Groups([
        'read:Pottery',
        'write:Pottery',
    ])]
    private ?Preservation $preservation;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Pottery
    {
        $this->id = $id;

        return $this;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $su): Pottery
    {
        $this->stratigraphicUnit = $su;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): Pottery
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): Pottery
    {
        $this->date = $date;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): Pottery
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): Pottery
    {
        $this->notes = $notes;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): Pottery
    {
        $this->period = $period;

        return $this;
    }

    public function getExternalSurfaceColour(): ?Colour
    {
        return $this->externalSurfaceColour;
    }

    public function setExternalSurfaceColour(?Colour $externalSurfaceColour): Pottery
    {
        $this->externalSurfaceColour = $externalSurfaceColour;

        return $this;
    }

    public function getInternalSurfaceColour(): ?Colour
    {
        return $this->internalSurfaceColour;
    }

    public function setInternalSurfaceColour(?Colour $internalSurfaceColour): Pottery
    {
        $this->internalSurfaceColour = $internalSurfaceColour;

        return $this;
    }

    public function getFractureColour(): ?Colour
    {
        return $this->fractureColour;
    }

    public function setFractureColour(?Colour $fractureColour): Pottery
    {
        $this->fractureColour = $fractureColour;

        return $this;
    }

    public function getWare(): ?Ware
    {
        return $this->ware;
    }

    public function setWare(?Ware $ware): Pottery
    {
        $this->ware = $ware;

        return $this;
    }

    public function getFabric(): ?Fabric
    {
        return $this->fabric;
    }

    public function setFabric(?Fabric $fabric): Pottery
    {
        $this->fabric = $fabric;

        return $this;
    }

    public function getSurfaceCharacteristic(): ?SurfaceCharacteristic
    {
        return $this->surfaceCharacteristic;
    }

    public function setSurfaceCharacteristic(?SurfaceCharacteristic $surfaceCharacteristic): Pottery
    {
        $this->surfaceCharacteristic = $surfaceCharacteristic;

        return $this;
    }

    public function getSurfaceTreatment(): ?SurfaceTreatment
    {
        return $this->surfaceTreatment;
    }

    public function setSurfaceTreatment(?SurfaceTreatment $surfaceTreatment): Pottery
    {
        $this->surfaceTreatment = $surfaceTreatment;

        return $this;
    }

    public function getManufacturingTechnique(): ?ManufacturingTechnique
    {
        return $this->manufacturingTechnique;
    }

    public function setManufacturingTechnique(?ManufacturingTechnique $manufacturingTechnique): Pottery
    {
        $this->manufacturingTechnique = $manufacturingTechnique;

        return $this;
    }

    public function getFiring(): ?Firing
    {
        return $this->firing;
    }

    public function setFiring(?Firing $firing): Pottery
    {
        $this->firing = $firing;

        return $this;
    }

    public function getDecoration(): ?Decoration
    {
        return $this->decoration;
    }

    public function setDecoration(?Decoration $decoration): Pottery
    {
        $this->decoration = $decoration;

        return $this;
    }

    public function getVesselShape(): ?VesselShape
    {
        return $this->vesselShape;
    }

    public function setVesselShape(?VesselShape $vesselShape): Pottery
    {
        $this->vesselShape = $vesselShape;

        return $this;
    }

    public function getRimShape(): ?RimShape
    {
        return $this->rimShape;
    }

    public function setRimShape(?RimShape $rimShape): Pottery
    {
        $this->rimShape = $rimShape;

        return $this;
    }

    public function getRimDirection(): ?RimDirection
    {
        return $this->rimDirection;
    }

    public function setRimDirection(?RimDirection $rimDirection): Pottery
    {
        $this->rimDirection = $rimDirection;

        return $this;
    }

    public function getThickness(): ?float
    {
        return $this->thickness;
    }

    public function setThickness(?float $thickness): Pottery
    {
        $this->thickness = $thickness;

        return $this;
    }

    public function getRimDiameter(): ?float
    {
        return $this->rimDiameter;
    }

    public function setRimDiameter(?float $rimDiameter): Pottery
    {
        $this->rimDiameter = $rimDiameter;

        return $this;
    }

    public function getBaseDiameter(): ?float
    {
        return $this->baseDiameter;
    }

    public function setBaseDiameter(?float $baseDiameter): Pottery
    {
        $this->baseDiameter = $baseDiameter;

        return $this;
    }

    public function getRimCharacterization(): ?RimCharacterization
    {
        return $this->rimCharacterization;
    }

    public function setRimCharacterization(?RimCharacterization $rimCharacterization): Pottery
    {
        $this->rimCharacterization = $rimCharacterization;

        return $this;
    }

    public function getNeck(): ?Neck
    {
        return $this->neck;
    }

    public function setNeck(?Neck $neck): Pottery
    {
        $this->neck = $neck;

        return $this;
    }

    public function getNeckLength(): ?NeckLength
    {
        return $this->neckLength;
    }

    public function setNeckLength(?NeckLength $neckLength): Pottery
    {
        $this->neckLength = $neckLength;

        return $this;
    }

    public function getBody(): ?Body
    {
        return $this->body;
    }

    public function setBody(?Body $body): Pottery
    {
        $this->body = $body;

        return $this;
    }

    public function getSpout(): ?Spout
    {
        return $this->spout;
    }

    public function setSpout(?Spout $spout): Pottery
    {
        $this->spout = $spout;

        return $this;
    }

    public function getHandle(): ?Handle
    {
        return $this->handle;
    }

    public function setHandle(?Handle $handle): Pottery
    {
        $this->handle = $handle;

        return $this;
    }

    public function getBaseShape(): ?BaseShape
    {
        return $this->baseShape;
    }

    public function setBaseShape(?BaseShape $baseShape): Pottery
    {
        $this->baseShape = $baseShape;

        return $this;
    }

    public function getSizeGroup(): ?SizeGroup
    {
        return $this->sizeGroup;
    }

    public function setSizeGroup(?SizeGroup $sizeGroup): Pottery
    {
        $this->sizeGroup = $sizeGroup;

        return $this;
    }

    public function getPreservation(): ?Preservation
    {
        return $this->preservation;
    }

    public function setPreservation(?Preservation $preservation): Pottery
    {
        $this->preservation = $preservation;

        return $this;
    }
}
