<?php

declare(strict_types=1);

namespace app\order\infrastructure\web\in;

use app\order\application\CalculateTheGrossPriceService;
use app\order\application\port\in\CalculateTheGrossPriceUseCase;

readonly class OrderController {
    private CalculateTheGrossPriceUseCase $calculateTheGrossPriceUseCase;

    public function __construct(CalculateTheGrossPriceUseCase $calculate_the_gross_price_use_case = null) {
        $this->calculateTheGrossPriceUseCase = $calculate_the_gross_price_use_case ?? new CalculateTheGrossPriceService();
    }

    public function handleCalculateTheGrossPriceOfSpecifiedOrder(int $order_id): float {
        return $this->calculateTheGrossPriceUseCase->execute($order_id);
    }
}
