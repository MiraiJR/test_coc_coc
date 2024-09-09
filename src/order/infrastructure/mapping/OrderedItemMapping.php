<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\OrderedItem;

class OrderedItemMapping
{
    private string $RAW_DATA_AMAZON_PRICE = "amazon_price";
    private string $RAW_DATA_WEIGHT = "weight";
    private string $RAW_DATA_HEIGHT = "height";
    private string $RAW_DATA_WIDTH = "width";
    private string $RAW_DATA_DEPTH = "depth";

    public function convertRawDataToDomainEntity(array $raw_data): OrderedItem
    {
        return new OrderedItem(
            $raw_data[$this->RAW_DATA_AMAZON_PRICE],
            $raw_data[$this->RAW_DATA_WEIGHT],
            $raw_data[$this->RAW_DATA_WIDTH],
            $raw_data[$this->RAW_DATA_HEIGHT],
            $raw_data[$this->RAW_DATA_DEPTH],
        );
    }
}
