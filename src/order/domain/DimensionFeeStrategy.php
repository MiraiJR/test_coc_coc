<?php

declare(strict_types=1);

namespace app\order\domain;

class DimensionFeeStrategy implements FeeStrategy
{

    public function calculateFee(OrderedItem $item, CoefficientConfiguration $coefficient_configuration): float
    {
        return $item->getArea() * $coefficient_configuration->getDimension();
    }
}
