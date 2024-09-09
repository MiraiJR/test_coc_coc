<?php

declare(strict_types=1);

namespace app\order\domain;

class WeightFeeStrategy implements FeeStrategy
{

    public function calculateFee(OrderedItem $item, CoefficientConfiguration $coefficient_configuration): float
    {
        return $item->getWeight() * $coefficient_configuration->getWeight();
    }
}
