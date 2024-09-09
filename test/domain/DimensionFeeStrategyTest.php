<?php

declare(strict_types=1);

namespace app\order\domain;

use PHPUnit\Framework\TestCase;

class DimensionFeeStrategyTest extends TestCase
{
    private DimensionFeeStrategy $dimensionFeeStrategy;

    public function setUp(): void
    {
        parent::setUp();
        $this->dimensionFeeStrategy = new DimensionFeeStrategy();
    }

    public function testCalculateFee()
    {
        $ordered_item = new OrderedItem(1.1, 2.4, 3.2, 3.4, 4.2);
        $coefficient_configuration = new CoefficientConfiguration(11, 11);
        $actual_result = $this->dimensionFeeStrategy->calculateFee($ordered_item, $coefficient_configuration);
        $expected_result = 502.66;
        $this->assertEquals($expected_result, $actual_result);
    }
}
