<?php

namespace App\Entity;

class CumulativePotterySheet
{
    private int $id;

    private SU $stratigraphicUnit;

    private \DateTimeImmutable $date;

    private string $compiler;

    public int $commonWareNonDiagnosticCount = 0;

    public int $commonWareDiagnosticCount = 0;

    public int $fireWareNonDiagnosticCount = 0;

    public int $fireWareDiagnosticCount = 0;

    public int $coarseWareNonDiagnosticCount = 0;

    public int $coarseWareDiagnosticCount = 0;

    public int $kitchenWareNonDiagnosticCount = 0;

    public int $kitchenWareDiagnosticCount = 0;

    public int $subperiodEPNCount = 0;

    public int $subperiodHASCount = 0;

    public int $subperiodSAMCount = 0;

    public int $subperiodHALCount = 0;

    public int $subperiodNUBCount = 0;

    public int $subperiodLCACount = 0;

    public int $subperiodLCA1Count = 0;

    public int $subperiodLCA2Count = 0;

    public int $subperiodLCA3Count = 0;

    public int $subperiodLCA4Count = 0;

    public int $subperiodLCA5Count = 0;

    public int $subperiodSURCount = 0;

    public int $subperiodEMTCount = 0;

    public int $subperiodEMT0Count = 0;

    public int $subperiodEMT1Count = 0;

    public int $subperiodEMT2Count = 0;

    public int $subperiodEMT3Count = 0;

    public int $subperiodEMT4Count = 0;

    public int $subperiodEMT5Count = 0;

    public int $subperiodMBACount = 0;

    public int $subperiodMBA1Count = 0;

    public int $subperiodMBA2Count = 0;

    public int $subperiodLBA1Count = 0;

    public int $subperiodLBA2Count = 0;

    public int $subperiodIRA1Count = 0;

    public int $subperiodIRA2Count = 0;

    public int $subperiodHELCount = 0;

    public int $subperiodPARCount = 0;

    public int $subperiodBYZCount = 0;

    public int $subperiodSASCount = 0;

    public int $subperiodISLCount = 0;

    public int $subperiodISL1Count = 0;

    public int $subperiodISL2Count = 0;

    public int $subperiodISL3Count = 0;

    public int $subperiodUndeterminedCount = 0;

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
