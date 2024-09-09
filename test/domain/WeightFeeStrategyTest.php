<?php

declare(strict_types=1);

namespace app\order\domain;

use PHPUnit\Framework\TestCase;

class WeightFeeStrategyTest extends TestCase
{
    private WeightFeeStrategy $weightFeeStrategy;

    public function setUp(): void
    {
        parent::setUp();
        $this->weightFeeStrategy = new WeightFeeStrategy();
    }

    public function testCalculateFee()
    {
        $ordered_item = new OrderedItem(1.1, 2.4, 3.2, 3.4, 4.2);
        $coefficient_configuration = new CoefficientConfiguration(11, 11);
        $actual_result = $this->weightFeeStrategy->calculateFee($ordered_item, $coefficient_configuration);
        $expected_result = 26.4;
        $this->assertEquals($expected_result, $actual_result);
    }
}
