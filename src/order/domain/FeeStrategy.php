<?php

declare(strict_types=1);

namespace app\order\domain;

interface FeeStrategy
{
    public function calculateFee(OrderedItem $item, CoefficientConfiguration $coefficient_configuration): float;
}
