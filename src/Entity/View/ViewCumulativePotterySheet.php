<?php

namespace App\Entity\View;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\SU;
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

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $commonWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $commonWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $fireWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $fireWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $coarseWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $coarseWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $kitchenWareNonDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $kitchenWareDiagnosticCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $cumulativeWareCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEPNCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodHASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodSAMCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodHALCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodNUBCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCA3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCA4Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLCA5Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodSURCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMTCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMT1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMT2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMT3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMT4Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodEMT5Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodMBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodMBA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodMBA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLBA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodLBA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodIRACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodIRA1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodIRA2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodHELCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodPARCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodBYZCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodSASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodISLCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodISL1Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodISL2Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodISL3Count = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private int $subperiodUndeterminedCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
        'write:ViewCumulativePotterySheet',
    ])]
    private ?string $notes;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodEPNCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodHASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodSAMCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodHALCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodNUBCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodLCACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodSURCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodEMTCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodMBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodLBACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodIRACount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodHELCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodPARCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodBYZCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodSASCount = 0;

    #[Groups([
        'read:ViewCumulativePotterySheet',
    ])]
    private int $periodISLCount = 0;

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

    public function getCommonWareNonDiagnosticCount(): int
    {
        return $this->commonWareNonDiagnosticCount;
    }

    public function setCommonWareNonDiagnosticCount(int $commonWareNonDiagnosticCount): self
    {
        $this->commonWareNonDiagnosticCount = $commonWareNonDiagnosticCount;

        return $this;
    }

    public function getCommonWareDiagnosticCount(): int
    {
        return $this->commonWareDiagnosticCount;
    }

    public function setCommonWareDiagnosticCount(int $commonWareDiagnosticCount): self
    {
        $this->commonWareDiagnosticCount = $commonWareDiagnosticCount;

        return $this;
    }

    public function getFireWareNonDiagnosticCount(): int
    {
        return $this->fireWareNonDiagnosticCount;
    }

    public function setFireWareNonDiagnosticCount(int $fireWareNonDiagnosticCount): self
    {
        $this->fireWareNonDiagnosticCount = $fireWareNonDiagnosticCount;

        return $this;
    }

    public function getFireWareDiagnosticCount(): int
    {
        return $this->fireWareDiagnosticCount;
    }

    public function setFireWareDiagnosticCount(int $fireWareDiagnosticCount): self
    {
        $this->fireWareDiagnosticCount = $fireWareDiagnosticCount;

        return $this;
    }

    public function getCoarseWareNonDiagnosticCount(): int
    {
        return $this->coarseWareNonDiagnosticCount;
    }

    public function setCoarseWareNonDiagnosticCount(int $coarseWareNonDiagnosticCount): self
    {
        $this->coarseWareNonDiagnosticCount = $coarseWareNonDiagnosticCount;

        return $this;
    }

    public function getCoarseWareDiagnosticCount(): int
    {
        return $this->coarseWareDiagnosticCount;
    }

    public function setCoarseWareDiagnosticCount(int $coarseWareDiagnosticCount): self
    {
        $this->coarseWareDiagnosticCount = $coarseWareDiagnosticCount;

        return $this;
    }

    public function getKitchenWareNonDiagnosticCount(): int
    {
        return $this->kitchenWareNonDiagnosticCount;
    }

    public function setKitchenWareNonDiagnosticCount(int $kitchenWareNonDiagnosticCount): self
    {
        $this->kitchenWareNonDiagnosticCount = $kitchenWareNonDiagnosticCount;

        return $this;
    }

    public function getKitchenWareDiagnosticCount(): int
    {
        return $this->kitchenWareDiagnosticCount;
    }

    public function setKitchenWareDiagnosticCount(int $kitchenWareDiagnosticCount): self
    {
        $this->kitchenWareDiagnosticCount = $kitchenWareDiagnosticCount;

        return $this;
    }

    public function getCumulativeWareCount(): int
    {
        return $this->cumulativeWareCount;
    }

    public function getSubperiodEPNCount(): int
    {
        return $this->subperiodEPNCount;
    }

    public function setSubperiodEPNCount(int $subperiodEPNCount): self
    {
        $this->subperiodEPNCount = $subperiodEPNCount;

        return $this;
    }

    public function getSubperiodHASCount(): int
    {
        return $this->subperiodHASCount;
    }

    public function setSubperiodHASCount(int $subperiodHASCount): self
    {
        $this->subperiodHASCount = $subperiodHASCount;

        return $this;
    }

    public function getSubperiodSAMCount(): int
    {
        return $this->subperiodSAMCount;
    }

    public function setSubperiodSAMCount(int $subperiodSAMCount): self
    {
        $this->subperiodSAMCount = $subperiodSAMCount;

        return $this;
    }

    public function getSubperiodHALCount(): int
    {
        return $this->subperiodHALCount;
    }

    public function setSubperiodHALCount(int $subperiodHALCount): self
    {
        $this->subperiodHALCount = $subperiodHALCount;

        return $this;
    }

    public function getSubperiodNUBCount(): int
    {
        return $this->subperiodNUBCount;
    }

    public function setSubperiodNUBCount(int $subperiodNUBCount): self
    {
        $this->subperiodNUBCount = $subperiodNUBCount;

        return $this;
    }

    public function getSubperiodLCACount(): int
    {
        return $this->subperiodLCACount;
    }

    public function setSubperiodLCACount(int $subperiodLCACount): self
    {
        $this->subperiodLCACount = $subperiodLCACount;

        return $this;
    }

    public function getSubperiodLCA1Count(): int
    {
        return $this->subperiodLCA1Count;
    }

    public function setSubperiodLCA1Count(int $subperiodLCA1Count): self
    {
        $this->subperiodLCA1Count = $subperiodLCA1Count;

        return $this;
    }

    public function getSubperiodLCA2Count(): int
    {
        return $this->subperiodLCA2Count;
    }

    public function setSubperiodLCA2Count(int $subperiodLCA2Count): self
    {
        $this->subperiodLCA2Count = $subperiodLCA2Count;

        return $this;
    }

    public function getSubperiodLCA3Count(): int
    {
        return $this->subperiodLCA3Count;
    }

    public function setSubperiodLCA3Count(int $subperiodLCA3Count): self
    {
        $this->subperiodLCA3Count = $subperiodLCA3Count;

        return $this;
    }

    public function getSubperiodLCA4Count(): int
    {
        return $this->subperiodLCA4Count;
    }

    public function setSubperiodLCA4Count(int $subperiodLCA4Count): self
    {
        $this->subperiodLCA4Count = $subperiodLCA4Count;

        return $this;
    }

    public function getSubperiodLCA5Count(): int
    {
        return $this->subperiodLCA5Count;
    }

    public function setSubperiodLCA5Count(int $subperiodLCA5Count): self
    {
        $this->subperiodLCA5Count = $subperiodLCA5Count;

        return $this;
    }

    public function getSubperiodSURCount(): int
    {
        return $this->subperiodSURCount;
    }

    public function setSubperiodSURCount(int $subperiodSURCount): self
    {
        $this->subperiodSURCount = $subperiodSURCount;

        return $this;
    }

    public function getSubperiodEMTCount(): int
    {
        return $this->subperiodEMTCount;
    }

    public function setSubperiodEMTCount(int $subperiodEMTCount): self
    {
        $this->subperiodEMTCount = $subperiodEMTCount;

        return $this;
    }

    public function getSubperiodEMT1Count(): int
    {
        return $this->subperiodEMT1Count;
    }

    public function setSubperiodEMT1Count(int $subperiodEMT1Count): self
    {
        $this->subperiodEMT1Count = $subperiodEMT1Count;

        return $this;
    }

    public function getSubperiodEMT2Count(): int
    {
        return $this->subperiodEMT2Count;
    }

    public function setSubperiodEMT2Count(int $subperiodEMT2Count): self
    {
        $this->subperiodEMT2Count = $subperiodEMT2Count;

        return $this;
    }

    public function getSubperiodEMT3Count(): int
    {
        return $this->subperiodEMT3Count;
    }

    public function setSubperiodEMT3Count(int $subperiodEMT3Count): self
    {
        $this->subperiodEMT3Count = $subperiodEMT3Count;

        return $this;
    }

    public function getSubperiodEMT4Count(): int
    {
        return $this->subperiodEMT4Count;
    }

    public function setSubperiodEMT4Count(int $subperiodEMT4Count): self
    {
        $this->subperiodEMT4Count = $subperiodEMT4Count;

        return $this;
    }

    public function getSubperiodEMT5Count(): int
    {
        return $this->subperiodEMT5Count;
    }

    public function setSubperiodEMT5Count(int $subperiodEMT5Count): self
    {
        $this->subperiodEMT5Count = $subperiodEMT5Count;

        return $this;
    }

    public function getSubperiodMBACount(): int
    {
        return $this->subperiodMBACount;
    }

    public function setSubperiodMBACount(int $subperiodMBACount): self
    {
        $this->subperiodMBACount = $subperiodMBACount;

        return $this;
    }

    public function getSubperiodMBA1Count(): int
    {
        return $this->subperiodMBA1Count;
    }

    public function setSubperiodMBA1Count(int $subperiodMBA1Count): self
    {
        $this->subperiodMBA1Count = $subperiodMBA1Count;

        return $this;
    }

    public function getSubperiodMBA2Count(): int
    {
        return $this->subperiodMBA2Count;
    }

    public function setSubperiodMBA2Count(int $subperiodMBA2Count): self
    {
        $this->subperiodMBA2Count = $subperiodMBA2Count;

        return $this;
    }

    public function getSubperiodLBACount(): int
    {
        return $this->subperiodLBACount;
    }

    public function setSubperiodLBACount(int $subperiodLBACount): self
    {
        $this->subperiodLBACount = $subperiodLBACount;

        return $this;
    }

    public function getSubperiodLBA1Count(): int
    {
        return $this->subperiodLBA1Count;
    }

    public function setSubperiodLBA1Count(int $subperiodLBA1Count): self
    {
        $this->subperiodLBA1Count = $subperiodLBA1Count;

        return $this;
    }

    public function getSubperiodLBA2Count(): int
    {
        return $this->subperiodLBA2Count;
    }

    public function setSubperiodLBA2Count(int $subperiodLBA2Count): self
    {
        $this->subperiodLBA2Count = $subperiodLBA2Count;

        return $this;
    }

    public function getSubperiodIRACount(): int
    {
        return $this->subperiodIRACount;
    }

    public function setSubperiodIRACount(int $subperiodIRACount): self
    {
        $this->subperiodIRACount = $subperiodIRACount;

        return $this;
    }

    public function getSubperiodIRA1Count(): int
    {
        return $this->subperiodIRA1Count;
    }

    public function setSubperiodIRA1Count(int $subperiodIRA1Count): self
    {
        $this->subperiodIRA1Count = $subperiodIRA1Count;

        return $this;
    }

    public function getSubperiodIRA2Count(): int
    {
        return $this->subperiodIRA2Count;
    }

    public function setSubperiodIRA2Count(int $subperiodIRA2Count): self
    {
        $this->subperiodIRA2Count = $subperiodIRA2Count;

        return $this;
    }

    public function getSubperiodHELCount(): int
    {
        return $this->subperiodHELCount;
    }

    public function setSubperiodHELCount(int $subperiodHELCount): self
    {
        $this->subperiodHELCount = $subperiodHELCount;

        return $this;
    }

    public function getSubperiodPARCount(): int
    {
        return $this->subperiodPARCount;
    }

    public function setSubperiodPARCount(int $subperiodPARCount): self
    {
        $this->subperiodPARCount = $subperiodPARCount;

        return $this;
    }

    public function getSubperiodBYZCount(): int
    {
        return $this->subperiodBYZCount;
    }

    public function setSubperiodBYZCount(int $subperiodBYZCount): self
    {
        $this->subperiodBYZCount = $subperiodBYZCount;

        return $this;
    }

    public function getSubperiodSASCount(): int
    {
        return $this->subperiodSASCount;
    }

    public function setSubperiodSASCount(int $subperiodSASCount): self
    {
        $this->subperiodSASCount = $subperiodSASCount;

        return $this;
    }

    public function getSubperiodISLCount(): int
    {
        return $this->subperiodISLCount;
    }

    public function setSubperiodISLCount(int $subperiodISLCount): self
    {
        $this->subperiodISLCount = $subperiodISLCount;

        return $this;
    }

    public function getSubperiodISL1Count(): int
    {
        return $this->subperiodISL1Count;
    }

    public function setSubperiodISL1Count(int $subperiodISL1Count): self
    {
        $this->subperiodISL1Count = $subperiodISL1Count;

        return $this;
    }

    public function getSubperiodISL2Count(): int
    {
        return $this->subperiodISL2Count;
    }

    public function setSubperiodISL2Count(int $subperiodISL2Count): self
    {
        $this->subperiodISL2Count = $subperiodISL2Count;

        return $this;
    }

    public function getSubperiodISL3Count(): int
    {
        return $this->subperiodISL3Count;
    }

    public function setSubperiodISL3Count(int $subperiodISL3Count): self
    {
        $this->subperiodISL3Count = $subperiodISL3Count;

        return $this;
    }

    public function getSubperiodUndeterminedCount(): int
    {
        return $this->subperiodUndeterminedCount;
    }

    public function setSubperiodUndeterminedCount(int $subperiodUndeterminedCount): self
    {
        $this->subperiodUndeterminedCount = $subperiodUndeterminedCount;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getPeriodEPNCount(): int
    {
        return $this->periodEPNCount;
    }

    public function getPeriodHASCount(): int
    {
        return $this->periodHASCount;
    }

    public function getPeriodSAMCount(): int
    {
        return $this->periodSAMCount;
    }

    public function getPeriodHALCount(): int
    {
        return $this->periodHALCount;
    }

    public function getPeriodNUBCount(): int
    {
        return $this->periodNUBCount;
    }

    public function getPeriodLCACount(): int
    {
        return $this->periodLCACount;
    }

    public function getPeriodSURCount(): int
    {
        return $this->periodSURCount;
    }

    public function getPeriodEMTCount(): int
    {
        return $this->periodEMTCount;
    }

    public function getPeriodMBACount(): int
    {
        return $this->periodMBACount;
    }

    public function getPeriodLBACount(): int
    {
        return $this->periodLBACount;
    }

    public function getPeriodIRACount(): int
    {
        return $this->periodIRACount;
    }

    public function getPeriodHELCount(): int
    {
        return $this->periodHELCount;
    }

    public function getPeriodPARCount(): int
    {
        return $this->periodPARCount;
    }

    public function getPeriodBYZCount(): int
    {
        return $this->periodBYZCount;
    }

    public function getPeriodSASCount(): int
    {
        return $this->periodSASCount;
    }

    public function getPeriodISLCount(): int
    {
        return $this->periodISLCount;
    }
}
