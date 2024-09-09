<?php

declare(strict_types=1);

namespace app\order\application;

use app\order\application\port\in\CalculateTheGrossPriceUseCase;
use app\order\application\port\out\GetCoefficientConfiguration;
use app\order\application\port\out\LoadOrder;
use app\order\infrastructure\persistence\CoefficientConfigurationRepository;
use app\order\infrastructure\persistence\OrderRepository;

readonly class CalculateTheGrossPriceService implements CalculateTheGrossPriceUseCase
{
    private GetCoefficientConfiguration $getCoefficientConfiguration;
    private LoadOrder $loadOrder;

    public function __construct(
        GetCoefficientConfiguration $get_coefficient_configuration = null,
        LoadOrder $load_order = null
    ) {
        $this->getCoefficientConfiguration = $get_coefficient_configuration ?? new CoefficientConfigurationRepository();
        $this->loadOrder = $load_order ?? new OrderRepository();
    }

    /**
     * @throws \Exception
     */
    public function execute(int $order_id): float
    {
        $coefficient_config = $this->getCoefficientConfiguration->getConfiguration();
        $order = $this->loadOrder->loadOrderById($order_id);
        return $order->calculateGrossPrice($coefficient_config);
    }
}
