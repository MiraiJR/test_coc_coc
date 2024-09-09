<?php

declare(strict_types=1);

namespace app\order\domain;

class CoefficientConfiguration
{
    private float $weight;
    private float $dimension;

    public function __construct(float $weight, float $dimension)
    {
        $this->weight = $weight;
        $this->dimension = $dimension;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getDimension(): float
    {
        return $this->dimension;
    }
}
