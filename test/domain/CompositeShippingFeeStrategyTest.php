<?php

declare(strict_types=1);

namespace app\order\domain;

use PHPUnit\Framework\TestCase;

class CompositeShippingFeeStrategyTest extends TestCase
{
    private CompositeShippingFeeStrategy $compositeShippingFeeStrategy;
    private DimensionFeeStrategy $dimensionFeeStrategyMock;
    private WeightFeeStrategy $weightFeeStrategyMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->weightFeeStrategyMock = $this->createMock(WeightFeeStrategy::class);
        $this->dimensionFeeStrategyMock = $this->createMock(DimensionFeeStrategy::class);
        $this->compositeShippingFeeStrategy = new CompositeShippingFeeStrategy(
            $this->weightFeeStrategyMock,
            $this->dimensionFeeStrategyMock
        );
    }

    public function testCalculateFee()
    {
        $ordered_item = new OrderedItem(1.1, 2.4, 3.2, 3.4, 4.2);
        $coefficient_configuration = new CoefficientConfiguration(11, 11);
        $this->dimensionFeeStrategyMock
            ->expects($this->once())
            ->method('calculateFee')
            ->willReturn(11.1)
        ;
        $this->weightFeeStrategyMock
            ->expects($this->once())
            ->method('calculateFee')
            ->willReturn(12.2)
        ;
        $expected_result = 12.2;
        $actual_result = $this->compositeShippingFeeStrategy->calculateFee($ordered_item, $coefficient_configuration);
        $this->assertEquals($expected_result, $actual_result);
    }
}
