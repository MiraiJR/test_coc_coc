<?php

declare(strict_types=1);

namespace app\order\application\port\in;

interface CalculateTheGrossPriceUseCase
{
    public function execute(int $order_id): float;
}
