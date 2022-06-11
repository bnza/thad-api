<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SU;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'post',
    ],
    itemOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'patch',
        'delete',
    ],
    shortName: 'CumulativePotterySheet',
    denormalizationContext: [
        'groups' => [
            'write:ViewCumulativePotterySheet',
        ],
    ],
    normalizationContext: [
        'groups' => [
            'read:ViewCumulativePotterySheet',
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
#[UniqueEntity(
    fields: ['stratigraphicUnit'],
    message: 'Duplicate cumulative pottery sheet for this SU',
    errorPath: 'stratigraphicUnit',
)]
class ViewCumulativePotterySheet
{
    #[Groups([
        'read:SU',
        'read:ViewCumulativePotterySheet',
    ])]
    private int $id;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private SU $stratigraphicUnit;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $number;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private ?string $compiler;

    public ?string $notes;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $commonWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $commonWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $fireWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $fireWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $coarseWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $coarseWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $kitchenWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $kitchenWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $cumulativeWareCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $diagnosticWareCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEPNCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodHASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodSAMCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodHALCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodNUBCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCA3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCA4Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLCA5Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodSURCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMTCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT0Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT4Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodEMT5Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodMBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodMBA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodMBA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLBA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodLBA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodIRA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodIRA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodHELCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodPARCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodBYZCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodSASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodISLCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodISL1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodISL2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodISL3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public int $subperiodUndeterminedCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodEPNCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodSAMCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHALCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodNUBCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodLCACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodEMTCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodMBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodLBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodIRACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHELCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodPARCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodBYZCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodSASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodISLCount = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): self
    {
        $this->stratigraphicUnit = $stratigraphicUnit;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): self
    {
        $this->compiler = $compiler;

        return $this;
    }

}
