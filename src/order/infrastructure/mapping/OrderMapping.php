<?php

declare(strict_types=1);

namespace app\order\infrastructure\mapping;

use app\order\domain\Order;

class OrderMapping {
    private readonly OrderedItemMapping $orderedItemMapping;
    public function __construct(OrderedItemMapping $ordered_item_mapping = null) {
        $this->orderedItemMapping = $ordered_item_mapping ?? new OrderedItemMapping();
    }
    public function convertRawDataToDomainEntity(array $raw_data): Order {
        $ordered_items = [];

        foreach ($raw_data as $raw_ordered_item) {
            $ordered_items[] = $this->orderedItemMapping->convertRawDataToDomainEntity($raw_ordered_item);
        }

        return new Order($ordered_items);
    }
}
