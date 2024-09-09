<?php

declare(strict_types=1);

namespace app\order\domain;

class CompositeShippingFeeStrategy implements FeeStrategy
{
    /** @var FeeStrategy[] */
    private array $feeStrategies;

    public function __construct(FeeStrategy ...$fee_strategies)
    {
        $this->feeStrategies = $fee_strategies;
    }

    public function calculateFee(OrderedItem $item, CoefficientConfiguration $coefficient_configuration): float
    {
        $fees = array_map(function(FeeStrategy $strategy) use ($item, $coefficient_configuration) {
            return $strategy->calculateFee($item, $coefficient_configuration);
        }, $this->feeStrategies);

        return max($fees);
    }
}
