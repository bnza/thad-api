<?php

namespace App\Entity;

class CumulativePotterySheet
{
    private int $id;

    private SU $stratigraphicUnit;

    private int $number;

    private \DateTimeImmutable $date;

    private ?string $compiler;

    private int $commonWareNonDiagnosticCount = 0;

    private int $commonWareDiagnosticCount = 0;

    private int $fireWareNonDiagnosticCount = 0;

    private int $fireWareDiagnosticCount = 0;

    private int $coarseWareNonDiagnosticCount = 0;

    private int $coarseWareDiagnosticCount = 0;

    private int $kitchenWareNonDiagnosticCount = 0;

    private int $kitchenWareDiagnosticCount = 0;

    private int $subperiodEPNCount = 0;

    private int $subperiodHASCount = 0;

    private int $subperiodSAMCount = 0;

    private int $subperiodHALCount = 0;

    private int $subperiodNUBCount = 0;

    private int $subperiodLCACount = 0;

    private int $subperiodLCA1Count = 0;

    private int $subperiodLCA2Count = 0;

    private int $subperiodLCA3Count = 0;

    private int $subperiodLCA4Count = 0;

    private int $subperiodLCA5Count = 0;

    private int $subperiodSURCount = 0;

    private int $subperiodEMTCount = 0;

    private int $subperiodEMT1Count = 0;

    private int $subperiodEMT2Count = 0;

    private int $subperiodEMT3Count = 0;

    private int $subperiodEMT4Count = 0;

    private int $subperiodEMT5Count = 0;

    private int $subperiodMBACount = 0;

    private int $subperiodMBA1Count = 0;

    private int $subperiodMBA2Count = 0;

    private int $subperiodLBACount = 0;

    private int $subperiodLBA1Count = 0;

    private int $subperiodLBA2Count = 0;

    private int $subperiodIRACount = 0;

    private int $subperiodIRA1Count = 0;

    private int $subperiodIRA2Count = 0;

    private int $subperiodHELCount = 0;

    private int $subperiodPARCount = 0;

    private int $subperiodBYZCount = 0;

    private int $subperiodSASCount = 0;

    private int $subperiodISLCount = 0;

    private int $subperiodISL1Count = 0;

    private int $subperiodISL2Count = 0;

    private int $subperiodISL3Count = 0;

    private int $subperiodUndeterminedCount = 0;

    private ?string $notes;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStratigraphicUnit(): SU
    {
        return $this->stratigraphicUnit;
    }

    public function setStratigraphicUnit(SU $stratigraphicUnit): CumulativePotterySheet
    {
        $this->stratigraphicUnit = $stratigraphicUnit;

        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): CumulativePotterySheet
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): CumulativePotterySheet
    {
        $this->date = $date;

        return $this;
    }

    public function getCompiler(): ?string
    {
        return $this->compiler;
    }

    public function setCompiler(?string $compiler): CumulativePotterySheet
    {
        $this->compiler = $compiler;

        return $this;
    }

    public function getCommonWareNonDiagnosticCount(): int
    {
        return $this->commonWareNonDiagnosticCount;
    }

    public function setCommonWareNonDiagnosticCount(int $commonWareNonDiagnosticCount): CumulativePotterySheet
    {
        $this->commonWareNonDiagnosticCount = $commonWareNonDiagnosticCount;

        return $this;
    }

    public function getCommonWareDiagnosticCount(): int
    {
        return $this->commonWareDiagnosticCount;
    }

    public function setCommonWareDiagnosticCount(int $commonWareDiagnosticCount): CumulativePotterySheet
    {
        $this->commonWareDiagnosticCount = $commonWareDiagnosticCount;

        return $this;
    }

    public function getFireWareNonDiagnosticCount(): int
    {
        return $this->fireWareNonDiagnosticCount;
    }

    public function setFireWareNonDiagnosticCount(int $fireWareNonDiagnosticCount): CumulativePotterySheet
    {
        $this->fireWareNonDiagnosticCount = $fireWareNonDiagnosticCount;

        return $this;
    }

    public function getFireWareDiagnosticCount(): int
    {
        return $this->fireWareDiagnosticCount;
    }

    public function setFireWareDiagnosticCount(int $fireWareDiagnosticCount): CumulativePotterySheet
    {
        $this->fireWareDiagnosticCount = $fireWareDiagnosticCount;

        return $this;
    }

    public function getCoarseWareNonDiagnosticCount(): int
    {
        return $this->coarseWareNonDiagnosticCount;
    }

    public function setCoarseWareNonDiagnosticCount(int $coarseWareNonDiagnosticCount): CumulativePotterySheet
    {
        $this->coarseWareNonDiagnosticCount = $coarseWareNonDiagnosticCount;

        return $this;
    }

    public function getCoarseWareDiagnosticCount(): int
    {
        return $this->coarseWareDiagnosticCount;
    }

    public function setCoarseWareDiagnosticCount(int $coarseWareDiagnosticCount): CumulativePotterySheet
    {
        $this->coarseWareDiagnosticCount = $coarseWareDiagnosticCount;

        return $this;
    }

    public function getKitchenWareNonDiagnosticCount(): int
    {
        return $this->kitchenWareNonDiagnosticCount;
    }

    public function setKitchenWareNonDiagnosticCount(int $kitchenWareNonDiagnosticCount): CumulativePotterySheet
    {
        $this->kitchenWareNonDiagnosticCount = $kitchenWareNonDiagnosticCount;

        return $this;
    }

    public function getKitchenWareDiagnosticCount(): int
    {
        return $this->kitchenWareDiagnosticCount;
    }

    public function setKitchenWareDiagnosticCount(int $kitchenWareDiagnosticCount): CumulativePotterySheet
    {
        $this->kitchenWareDiagnosticCount = $kitchenWareDiagnosticCount;

        return $this;
    }

    public function getSubperiodEPNCount(): int
    {
        return $this->subperiodEPNCount;
    }

    public function setSubperiodEPNCount(int $subperiodEPNCount): CumulativePotterySheet
    {
        $this->subperiodEPNCount = $subperiodEPNCount;

        return $this;
    }

    public function getSubperiodHASCount(): int
    {
        return $this->subperiodHASCount;
    }

    public function setSubperiodHASCount(int $subperiodHASCount): CumulativePotterySheet
    {
        $this->subperiodHASCount = $subperiodHASCount;

        return $this;
    }

    public function getSubperiodSAMCount(): int
    {
        return $this->subperiodSAMCount;
    }

    public function setSubperiodSAMCount(int $subperiodSAMCount): CumulativePotterySheet
    {
        $this->subperiodSAMCount = $subperiodSAMCount;

        return $this;
    }

    public function getSubperiodHALCount(): int
    {
        return $this->subperiodHALCount;
    }

    public function setSubperiodHALCount(int $subperiodHALCount): CumulativePotterySheet
    {
        $this->subperiodHALCount = $subperiodHALCount;

        return $this;
    }

    public function getSubperiodNUBCount(): int
    {
        return $this->subperiodNUBCount;
    }

    public function setSubperiodNUBCount(int $subperiodNUBCount): CumulativePotterySheet
    {
        $this->subperiodNUBCount = $subperiodNUBCount;

        return $this;
    }

    public function getSubperiodLCACount(): int
    {
        return $this->subperiodLCACount;
    }

    public function setSubperiodLCACount(int $subperiodLCACount): CumulativePotterySheet
    {
        $this->subperiodLCACount = $subperiodLCACount;

        return $this;
    }

    public function getSubperiodLCA1Count(): int
    {
        return $this->subperiodLCA1Count;
    }

    public function setSubperiodLCA1Count(int $subperiodLCA1Count): CumulativePotterySheet
    {
        $this->subperiodLCA1Count = $subperiodLCA1Count;

        return $this;
    }

    public function getSubperiodLCA2Count(): int
    {
        return $this->subperiodLCA2Count;
    }

    public function setSubperiodLCA2Count(int $subperiodLCA2Count): CumulativePotterySheet
    {
        $this->subperiodLCA2Count = $subperiodLCA2Count;

        return $this;
    }

    public function getSubperiodLCA3Count(): int
    {
        return $this->subperiodLCA3Count;
    }

    public function setSubperiodLCA3Count(int $subperiodLCA3Count): CumulativePotterySheet
    {
        $this->subperiodLCA3Count = $subperiodLCA3Count;

        return $this;
    }

    public function getSubperiodLCA4Count(): int
    {
        return $this->subperiodLCA4Count;
    }

    public function setSubperiodLCA4Count(int $subperiodLCA4Count): CumulativePotterySheet
    {
        $this->subperiodLCA4Count = $subperiodLCA4Count;

        return $this;
    }

    public function getSubperiodLCA5Count(): int
    {
        return $this->subperiodLCA5Count;
    }

    public function setSubperiodLCA5Count(int $subperiodLCA5Count): CumulativePotterySheet
    {
        $this->subperiodLCA5Count = $subperiodLCA5Count;

        return $this;
    }

    public function getSubperiodSURCount(): int
    {
        return $this->subperiodSURCount;
    }

    public function setSubperiodSURCount(int $subperiodSURCount): CumulativePotterySheet
    {
        $this->subperiodSURCount = $subperiodSURCount;

        return $this;
    }

    public function getSubperiodEMTCount(): int
    {
        return $this->subperiodEMTCount;
    }

    public function setSubperiodEMTCount(int $subperiodEMTCount): CumulativePotterySheet
    {
        $this->subperiodEMTCount = $subperiodEMTCount;

        return $this;
    }

    public function getSubperiodEMT1Count(): int
    {
        return $this->subperiodEMT1Count;
    }

    public function setSubperiodEMT1Count(int $subperiodEMT1Count): CumulativePotterySheet
    {
        $this->subperiodEMT1Count = $subperiodEMT1Count;

        return $this;
    }

    public function getSubperiodEMT2Count(): int
    {
        return $this->subperiodEMT2Count;
    }

    public function setSubperiodEMT2Count(int $subperiodEMT2Count): CumulativePotterySheet
    {
        $this->subperiodEMT2Count = $subperiodEMT2Count;

        return $this;
    }

    public function getSubperiodEMT3Count(): int
    {
        return $this->subperiodEMT3Count;
    }

    public function setSubperiodEMT3Count(int $subperiodEMT3Count): CumulativePotterySheet
    {
        $this->subperiodEMT3Count = $subperiodEMT3Count;

        return $this;
    }

    public function getSubperiodEMT4Count(): int
    {
        return $this->subperiodEMT4Count;
    }

    public function setSubperiodEMT4Count(int $subperiodEMT4Count): CumulativePotterySheet
    {
        $this->subperiodEMT4Count = $subperiodEMT4Count;

        return $this;
    }

    public function getSubperiodEMT5Count(): int
    {
        return $this->subperiodEMT5Count;
    }

    public function setSubperiodEMT5Count(int $subperiodEMT5Count): CumulativePotterySheet
    {
        $this->subperiodEMT5Count = $subperiodEMT5Count;

        return $this;
    }

    public function getSubperiodMBACount(): int
    {
        return $this->subperiodMBACount;
    }

    public function setSubperiodMBACount(int $subperiodMBACount): CumulativePotterySheet
    {
        $this->subperiodMBACount = $subperiodMBACount;

        return $this;
    }

    public function getSubperiodMBA1Count(): int
    {
        return $this->subperiodMBA1Count;
    }

    public function setSubperiodMBA1Count(int $subperiodMBA1Count): CumulativePotterySheet
    {
        $this->subperiodMBA1Count = $subperiodMBA1Count;

        return $this;
    }

    public function getSubperiodMBA2Count(): int
    {
        return $this->subperiodMBA2Count;
    }

    public function setSubperiodMBA2Count(int $subperiodMBA2Count): CumulativePotterySheet
    {
        $this->subperiodMBA2Count = $subperiodMBA2Count;

        return $this;
    }

    public function getSubperiodLBACount(): int
    {
        return $this->subperiodLBACount;
    }

    public function setSubperiodLBACount(int $subperiodLBACount): CumulativePotterySheet
    {
        $this->subperiodLBACount = $subperiodLBACount;

        return $this;
    }

    public function getSubperiodLBA1Count(): int
    {
        return $this->subperiodLBA1Count;
    }

    public function setSubperiodLBA1Count(int $subperiodLBA1Count): CumulativePotterySheet
    {
        $this->subperiodLBA1Count = $subperiodLBA1Count;

        return $this;
    }

    public function getSubperiodLBA2Count(): int
    {
        return $this->subperiodLBA2Count;
    }

    public function setSubperiodLBA2Count(int $subperiodLBA2Count): CumulativePotterySheet
    {
        $this->subperiodLBA2Count = $subperiodLBA2Count;

        return $this;
    }

    public function getSubperiodIRACount(): int
    {
        return $this->subperiodIRACount;
    }

    public function setSubperiodIRACount(int $subperiodIRACount): CumulativePotterySheet
    {
        $this->subperiodIRACount = $subperiodIRACount;

        return $this;
    }

    public function getSubperiodIRA1Count(): int
    {
        return $this->subperiodIRA1Count;
    }

    public function setSubperiodIRA1Count(int $subperiodIRA1Count): CumulativePotterySheet
    {
        $this->subperiodIRA1Count = $subperiodIRA1Count;

        return $this;
    }

    public function getSubperiodIRA2Count(): int
    {
        return $this->subperiodIRA2Count;
    }

    public function setSubperiodIRA2Count(int $subperiodIRA2Count): CumulativePotterySheet
    {
        $this->subperiodIRA2Count = $subperiodIRA2Count;

        return $this;
    }

    public function getSubperiodHELCount(): int
    {
        return $this->subperiodHELCount;
    }

    public function setSubperiodHELCount(int $subperiodHELCount): CumulativePotterySheet
    {
        $this->subperiodHELCount = $subperiodHELCount;

        return $this;
    }

    public function getSubperiodPARCount(): int
    {
        return $this->subperiodPARCount;
    }

    public function setSubperiodPARCount(int $subperiodPARCount): CumulativePotterySheet
    {
        $this->subperiodPARCount = $subperiodPARCount;

        return $this;
    }

    public function getSubperiodBYZCount(): int
    {
        return $this->subperiodBYZCount;
    }

    public function setSubperiodBYZCount(int $subperiodBYZCount): CumulativePotterySheet
    {
        $this->subperiodBYZCount = $subperiodBYZCount;

        return $this;
    }

    public function getSubperiodSASCount(): int
    {
        return $this->subperiodSASCount;
    }

    public function setSubperiodSASCount(int $subperiodSASCount): CumulativePotterySheet
    {
        $this->subperiodSASCount = $subperiodSASCount;

        return $this;
    }

    public function getSubperiodISLCount(): int
    {
        return $this->subperiodISLCount;
    }

    public function setSubperiodISLCount(int $subperiodISLCount): CumulativePotterySheet
    {
        $this->subperiodISLCount = $subperiodISLCount;

        return $this;
    }

    public function getSubperiodISL1Count(): int
    {
        return $this->subperiodISL1Count;
    }

    public function setSubperiodISL1Count(int $subperiodISL1Count): CumulativePotterySheet
    {
        $this->subperiodISL1Count = $subperiodISL1Count;

        return $this;
    }

    public function getSubperiodISL2Count(): int
    {
        return $this->subperiodISL2Count;
    }

    public function setSubperiodISL2Count(int $subperiodISL2Count): CumulativePotterySheet
    {
        $this->subperiodISL2Count = $subperiodISL2Count;

        return $this;
    }

    public function getSubperiodISL3Count(): int
    {
        return $this->subperiodISL3Count;
    }

    public function setSubperiodISL3Count(int $subperiodISL3Count): CumulativePotterySheet
    {
        $this->subperiodISL3Count = $subperiodISL3Count;

        return $this;
    }

    public function getSubperiodUndeterminedCount(): int
    {
        return $this->subperiodUndeterminedCount;
    }

    public function setSubperiodUndeterminedCount(int $subperiodUndeterminedCount): CumulativePotterySheet
    {
        $this->subperiodUndeterminedCount = $subperiodUndeterminedCount;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): CumulativePotterySheet
    {
        $this->notes = $notes;

        return $this;
    }
}
