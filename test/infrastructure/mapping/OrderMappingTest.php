<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\Order;
use app\order\domain\OrderedItem;
use PHPUnit\Framework\TestCase;

class OrderMappingTest extends TestCase
{
    private OrderMapping $orderMapping;
    private OrderedItemMapping $orderedItemMappingMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderedItemMappingMock = $this->createMock(OrderedItemMapping::class);
        $this->orderMapping = new OrderMapping($this->orderedItemMappingMock);
    }

    public function testConvertRawDataToDomainEntity()
    {
        $ordered_items = [];
        $ordered_items[] = new OrderedItem(1, 1, 1, 1, 1);
        $ordered_items[] = new OrderedItem(2, 2, 2, 2, 2);
        $raw_data = [
            [
                OrderedItemMapping::RAW_DATA_DEPTH        => 1,
                OrderedItemMapping::RAW_DATA_HEIGHT       => 1,
                OrderedItemMapping::RAW_DATA_WIDTH        => 1,
                OrderedItemMapping::RAW_DATA_AMAZON_PRICE => 1,
                OrderedItemMapping::RAW_DATA_WEIGHT       => 1,
            ],
            [
                OrderedItemMapping::RAW_DATA_DEPTH        => 2,
                OrderedItemMapping::RAW_DATA_HEIGHT       => 2,
                OrderedItemMapping::RAW_DATA_WIDTH        => 2,
                OrderedItemMapping::RAW_DATA_AMAZON_PRICE => 2,
                OrderedItemMapping::RAW_DATA_WEIGHT       => 2,
            ],
        ];
        $this->orderedItemMappingMock
            ->expects($this->exactly(2))
            ->method('convertRawDataToDomainEntity')
            ->willReturn($ordered_items[0], $ordered_items[1])
        ;

        $expected_result = new Order($ordered_items);
        $actual_result = $this->orderMapping->convertRawDataToDomainEntity($raw_data);
        $this->assertEquals($expected_result, $actual_result);
    }
}
