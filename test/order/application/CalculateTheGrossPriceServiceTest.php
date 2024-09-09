<?php

declare(strict_types=1);

namespace app\order\application;

use app\order\application\port\out\GetCoefficientConfiguration;
use app\order\application\port\out\LoadOrder;
use app\order\domain\CoefficientConfiguration;
use app\order\domain\Order;
use app\order\domain\OrderedItem;
use PHPUnit\Framework\TestCase;

class CalculateTheGrossPriceServiceTest extends TestCase
{
    private CalculateTheGrossPriceService $calculateTheGrossPriceService;
    private GetCoefficientConfiguration $getCoefficientConfigurationMock;
    private LoadOrder $loadOrderMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->getCoefficientConfigurationMock = $this->createMock(GetCoefficientConfiguration::class);
        $this->loadOrderMock = $this->createMock(LoadOrder::class);
        $this->calculateTheGrossPriceService = new CalculateTheGrossPriceService(
            $this->getCoefficientConfigurationMock,
            $this->loadOrderMock
        );
    }

    public function testExecute_success() {
        $ordered_item_1 = new OrderedItem(1.1, 2.4, 3.2,3.4,4.2);
        $ordered_item_2 = new OrderedItem(1, 1.12, 1.23,2.3,1);
        $this->loadOrderMock->expects($this->once())
            ->method('loadOrderById')
            ->willReturn(new Order([$ordered_item_1, $ordered_item_2]));
        $this->getCoefficientConfigurationMock->expects($this->once())
            ->method('getConfiguration')
            ->willReturn(new CoefficientConfiguration(11,11));
        $expected_result = 535.88;
        $actual_result = $this->calculateTheGrossPriceService->execute(1);
        $this->assertEquals($expected_result, $actual_result);
    }

    public function testExecute_exception() {
        $this->loadOrderMock->expects($this->once())
                            ->method('loadOrderById')
                            ->willThrowException(new \Exception("Order not found"));
        $this->getCoefficientConfigurationMock->expects($this->once())
                                              ->method('getConfiguration')
                                              ->willReturn(new CoefficientConfiguration(11,11));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Order not found");

        $this->calculateTheGrossPriceService->execute(1);
    }
}
