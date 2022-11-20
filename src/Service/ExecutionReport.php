<?php

namespace Ang3\Bundle\AwsLambdaBundle\Service;

class ExecutionReport
{
    public const DURATION_PER_GO_S = 0.00001667;

    private float $duration = 0.000;
    private float $initDuration = 0.000;
    private float $billedDuration = 0.000;
    private float $memorySize = 0.000;
    private float $maxMemorySize = 0.000;

    public function getDuration(): float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getInitDuration(): float
    {
        return $this->initDuration;
    }

    public function setInitDuration(float $initDuration): self
    {
        $this->initDuration = $initDuration;

        return $this;
    }

    public function getBilledDuration(): float
    {
        return $this->billedDuration;
    }

    public function setBilledDuration(float $billedDuration): self
    {
        $this->billedDuration = $billedDuration;

        return $this;
    }

    public function getMemorySize(): float
    {
        return $this->memorySize;
    }

    public function setMemorySize(float $memorySize): self
    {
        $this->memorySize = $memorySize;

        return $this;
    }

    public function getMaxMemorySize(): float
    {
        return $this->maxMemorySize;
    }

    public function setMaxMemorySize(float $maxMemorySize): self
    {
        $this->maxMemorySize = $maxMemorySize;

        return $this;
    }

    public function getCost(): float
    {
        return $this->getCalculationRate() * self::DURATION_PER_GO_S;
    }

    public function getCalculationRate(): float
    {
        if (0 == $this->memorySize) {
            return 0;
        }

        return ($this->billedDuration / 1000) * ($this->memorySize / 1024);
    }
}
