<?php

declare(strict_types=1);

namespace app\order\domain;

class WeightFeeStrategy implements FeeStrategy
{
    public function calculateFee(OrderedItem $item, CoefficientConfiguration $coefficient_configuration): float
    {
        return round($item->getWeight() * $coefficient_configuration->getWeight(), 2);
    }
}
