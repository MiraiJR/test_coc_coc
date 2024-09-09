<?php

declare(strict_types=1);

namespace app\order\domain;

class Order
{
    /** @var OrderedItem[] */
    private array $items;
    private CompositeShippingFeeStrategy $shippingFeeCalculator;

    public function __construct(array $items, CompositeShippingFeeStrategy $shipping_fee_calculator = null)
    {
        $this->items = $items;
        $this->shippingFeeCalculator = $shipping_fee_calculator ?? new CompositeShippingFeeStrategy(
            new WeightFeeStrategy(),
            new DimensionFeeStrategy(),
        );
    }

    public function calculateGrossPrice(CoefficientConfiguration $coefficient_configuration): float
    {
        $gross_price = 0;

        foreach ($this->items as $item) {
            $gross_price += $item->getPrice() + $this->shippingFeeCalculator->calculateFee(
                    $item,
                    $coefficient_configuration
                );
        }

        return round($gross_price, 2);
    }
}
