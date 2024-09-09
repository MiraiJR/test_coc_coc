<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\OrderedItem;
use PHPUnit\Framework\TestCase;

class OrderedItemMappingTest extends TestCase
{
    public function testConvertRawDataToDomainEntity()
    {
        $ordered_item_mapping = new OrderedItemMapping();
        $expected_result = new OrderedItem(1, 1, 1, 1, 1);
        $actual_result = $ordered_item_mapping->convertRawDataToDomainEntity(
            [
                OrderedItemMapping::RAW_DATA_DEPTH        => 1,
                OrderedItemMapping::RAW_DATA_HEIGHT       => 1,
                OrderedItemMapping::RAW_DATA_WIDTH        => 1,
                OrderedItemMapping::RAW_DATA_AMAZON_PRICE => 1,
                OrderedItemMapping::RAW_DATA_WEIGHT       => 1,
            ]
        );
        $this->assertEquals($expected_result, $actual_result);
    }
}
