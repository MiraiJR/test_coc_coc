<?php

declare(strict_types=1);

namespace app\order\application\port\out;

use app\order\domain\Order;

interface LoadOrder
{
    public function loadOrderById(int $order_id): Order;
}
