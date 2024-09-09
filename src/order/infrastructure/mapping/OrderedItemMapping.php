<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\OrderedItem;

class OrderedItemMapping
{
    const RAW_DATA_AMAZON_PRICE = "amazon_price";
    const RAW_DATA_WEIGHT = "weight";
    const RAW_DATA_HEIGHT = "height";
    const RAW_DATA_WIDTH = "width";
    const RAW_DATA_DEPTH = "depth";

    public function convertRawDataToDomainEntity(array $raw_data): OrderedItem
    {
        return new OrderedItem(
            $raw_data[self::RAW_DATA_AMAZON_PRICE],
            $raw_data[self::RAW_DATA_WEIGHT],
            $raw_data[self::RAW_DATA_WIDTH],
            $raw_data[self::RAW_DATA_HEIGHT],
            $raw_data[self::RAW_DATA_DEPTH],
        );
    }
}
