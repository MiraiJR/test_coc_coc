<?php

declare(strict_types=1);

namespace app\order\infrastructure\persistence;

use app\order\application\port\out\LoadOrder;
use app\order\domain\Order;
use app\order\infrastructure\mapping\OrderMapping;

class OrderRepository implements LoadOrder
{
    private readonly OrderMapping $orderMapping;

    public function __construct(OrderMapping $order_mapping = null)
    {
        $this->orderMapping = $order_mapping ?? new OrderMapping();
    }

    /**
     * @throws \Exception
     */
    public function loadOrderById(int $order_id): Order
    {
        $raw_data = file_get_contents(__DIR__ . '/../data_storage/order/order_' . $order_id . '.json');

        if (!$raw_data) {
            throw new \Exception("Order not found");
        }

        $order_raw_data = json_decode($raw_data, true);
        return $this->orderMapping->convertRawDataToDomainEntity($order_raw_data);
    }
}
