<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ResourceExportController;
use App\Entity\SU;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'security' => 'is_granted("ROLE_USER")',
        ],
        'export' => [
            'controller' => ResourceExportController::class,
            'method' => 'GET',
            'path' => '/cumulative_pottery_sheets/export',
            'formats' => [
                'csv' => ['text/csv'],
            ],
            'normalization_context' => [
                'groups' => [
                    'export:ViewCumulativePotterySheet',
                ],
            ],
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
        'date' => 'exact',
        'commonWareNonDiagnosticCount' => 'exact',
        'commonWareDiagnosticCount' => 'exact',
        'fineWareNonDiagnosticCount' => 'exact',
        'fineWareDiagnosticCount' => 'exact',
        'coarseWareNonDiagnosticCount' => 'exact',
        'coarseWareDiagnosticCount' => 'exact',
        'kitchenWareNonDiagnosticCount' => 'exact',
        'kitchenWareDiagnosticCount' => 'exact',
        'cumulativeWareCount' => 'exact',
        'diagnosticWareCount' => 'exact',
        'subperiodEPNCount' => 'exact',
        'subperiodHASCount' => 'exact',
        'subperiodSAMCount' => 'exact',
        'subperiodHALCount' => 'exact',
        'subperiodNUBCount' => 'exact',
        'subperiodLCACount' => 'exact',
        'subperiodLCA1Count' => 'exact',
        'subperiodLCA2Count' => 'exact',
        'subperiodLCA3Count' => 'exact',
        'subperiodLCA4Count' => 'exact',
        'subperiodLCA5Count' => 'exact',
        'subperiodSURCount' => 'exact',
        'subperiodEMTCount' => 'exact',
        'subperiodEMT1Count' => 'exact',
        'subperiodEMT2Count' => 'exact',
        'subperiodEMT3Count' => 'exact',
        'subperiodEMT4Count' => 'exact',
        'subperiodEMT5Count' => 'exact',
        'subperiodMBACount' => 'exact',
        'subperiodMBA1Count' => 'exact',
        'subperiodMBA2Count' => 'exact',
        'subperiodLBA1Count' => 'exact',
        'subperiodLBA2Count' => 'exact',
        'subperiodIRA1Count' => 'exact',
        'subperiodIRA2Count' => 'exact',
        'subperiodHELCount' => 'exact',
        'subperiodPARCount' => 'exact',
        'subperiodBYZCount' => 'exact',
        'subperiodSASCount' => 'exact',
        'subperiodISLCount' => 'exact',
        'subperiodISL1Count' => 'exact',
        'subperiodISL2Count' => 'exact',
        'subperiodBISL3Count' => 'exact',
        'periodEPNCount' => 'exact',
        'periodHASCount' => 'exact',
        'periodSAMCount' => 'exact',
        'periodHALCount' => 'exact',
        'periodNUBCount' => 'exact',
        'periodLCACount' => 'exact',
        'periodEBACount' => 'exact',
        'periodMBACount' => 'exact',
        'periodLBACount' => 'exact',
        'periodIRACount' => 'exact',
        'periodHELCount' => 'exact',
        'periodPARCount' => 'exact',
        'periodBYZCount' => 'exact',
        'periodSASCount' => 'exact',
        'periodISLCount' => 'exact',
        'appId.code' => 'partial',
    ]
)]
#[ApiFilter(
    RangeFilter::class,
    properties: [
        'stratigraphicUnit.number',
        'commonWareNonDiagnosticCount',
        'commonWareDiagnosticCount',
        'fineWareNonDiagnosticCount',
        'fineWareDiagnosticCount',
        'coarseWareNonDiagnosticCount',
        'coarseWareDiagnosticCount',
        'kitchenWareNonDiagnosticCount',
        'kitchenWareDiagnosticCount',
        'cumulativeWareCount',
        'diagnosticWareCount',
        'subperiodEPNCount',
        'subperiodHASCount',
        'subperiodSAMCount',
        'subperiodHALCount',
        'subperiodNUBCount',
        'subperiodLCACount',
        'subperiodLCA1Count',
        'subperiodLCA2Count',
        'subperiodLCA3Count',
        'subperiodLCA4Count',
        'subperiodLCA5Count',
        'subperiodSURCount',
        'subperiodEMTCount',
        'subperiodEMT1Count',
        'subperiodEMT2Count',
        'subperiodEMT3Count',
        'subperiodEMT4Count',
        'subperiodEMT5Count',
        'subperiodMBACount',
        'subperiodMBA1Count',
        'subperiodMBA2Count',
        'subperiodLBA1Count',
        'subperiodLBA2Count',
        'subperiodIRA1Count',
        'subperiodIRA2Count',
        'subperiodHELCount',
        'subperiodPARCount',
        'subperiodBYZCount',
        'subperiodSASCount',
        'subperiodISLCount',
        'subperiodISL1Count',
        'subperiodISL2Count',
        'subperiodBISL3Count',
        'periodEPNCount',
        'periodHASCount',
        'periodSAMCount',
        'periodHALCount',
        'periodNUBCount',
        'periodLCACount',
        'periodEBACount',
        'periodMBACount',
        'periodLBACount',
        'periodIRACount',
        'periodHELCount',
        'periodPARCount',
        'periodBYZCount',
        'periodSASCount',
        'periodISLCount',
        'appId.code',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id',
        'stratigraphicUnit.area.code',
        'stratigraphicUnit.site.code',
        'stratigraphicUnit.number',
        'compiler',
        'date',
        'notes',
        'commonWareNonDiagnosticCount',
        'commonWareDiagnosticCount',
        'fineWareNonDiagnosticCount',
        'fineWareDiagnosticCount',
        'coarseWareNonDiagnosticCount',
        'coarseWareDiagnosticCount',
        'kitchenWareNonDiagnosticCount',
        'kitchenWareDiagnosticCount',
        'cumulativeWareCount',
        'diagnosticWareCount',
        'subperiodEPNCount',
        'subperiodHASCount',
        'subperiodSAMCount',
        'subperiodHALCount',
        'subperiodNUBCount',
        'subperiodLCACount',
        'subperiodLCA1Count',
        'subperiodLCA2Count',
        'subperiodLCA3Count',
        'subperiodLCA4Count',
        'subperiodLCA5Count',
        'subperiodSURCount',
        'subperiodEMTCount',
        'subperiodEMT1Count',
        'subperiodEMT2Count',
        'subperiodEMT3Count',
        'subperiodEMT4Count',
        'subperiodEMT5Count',
        'subperiodMBACount',
        'subperiodMBA1Count',
        'subperiodMBA2Count',
        'subperiodLBA1Count',
        'subperiodLBA2Count',
        'subperiodIRA1Count',
        'subperiodIRA2Count',
        'subperiodHELCount',
        'subperiodPARCount',
        'subperiodBYZCount',
        'subperiodSASCount',
        'subperiodISLCount',
        'subperiodISL1Count',
        'subperiodISL2Count',
        'subperiodBISL3Count',
        'periodEPNCount',
        'periodHASCount',
        'periodSAMCount',
        'periodHALCount',
        'periodNUBCount',
        'periodLCACount',
        'periodEBACount',
        'periodMBACount',
        'periodLBACount',
        'periodIRACount',
        'periodHELCount',
        'periodPARCount',
        'periodBYZCount',
        'periodSASCount',
        'periodISLCount',
    ]
)]
#[ApiFilter(
    DateFilter::class,
    properties: [
        'date',
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
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\NotBlank]
    private SU $stratigraphicUnit;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private \DateTimeImmutable $date;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\NotBlank]
    private string $compiler;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    public ?string $notes;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $commonWareNonDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $commonWareDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $fineWareNonDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $fineWareDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $coarseWareNonDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $coarseWareDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $kitchenWareNonDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $kitchenWareDiagnosticCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $cumulativeWareCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $diagnosticWareCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEPNCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodHASCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodSAMCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodHALCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodNUBCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCA1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCA2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCA3Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCA4Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLCA5Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodSURCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMTCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT0Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT3Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT4Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodEMT5Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodMBACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodMBA1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodMBA2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLBA1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodLBA2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodIRA1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodIRA2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodHELCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodPARCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodBYZCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodSASCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodISLCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodISL1Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodISL2Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodISL3Count = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    #[Assert\PositiveOrZero]
    public int $subperiodUndeterminedCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodEPNCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHASCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodSAMCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHALCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodNUBCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodLCACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodEBACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodMBACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodLBACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodIRACount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodHELCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodPARCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodBYZCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodSASCount = 0;

    #[Groups([
        'export:ViewCumulativePotterySheet',
        'read:ViewCumulativePotterySheet',
    ])]
    public int $periodISLCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'export:ViewCumulativePotterySheet',
    ])]
    public ViewAppIdCumulativePotterySheet $appId;

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

    public function getCompiler(): string
    {
        return $this->compiler;
    }

    public function setCompiler(string $compiler): self
    {
        $this->compiler = $compiler;

        return $this;
    }

}
