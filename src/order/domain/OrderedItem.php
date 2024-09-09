<?php

declare(strict_types=1);

namespace app\order\domain;

class OrderedItem
{
    private float $price;
    private float $weight;
    private float $width;
    private float $height;
    private float $depth;

    public function __construct(float $price, float $weight, float $width, float $height, float $depth)
    {
        $this->width = $width;
        $this->depth = $depth;
        $this->price = $price;
        $this->height = $height;
        $this->weight = $weight;
    }

    public function getArea(): float
    {
        return round($this->width * $this->height * $this->depth, 2);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getDepth(): float
    {
        return $this->depth;
    }

    public function getWidth(): float
    {
        return $this->width;
    }
}
