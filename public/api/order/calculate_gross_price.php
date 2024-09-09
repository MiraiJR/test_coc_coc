<?php

declare(strict_types=1);

require_once "../../prepend.php";

use app\order\infrastructure\web\in\OrderController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_controller = new OrderController();
    $gross_price = $order_controller->handleCalculateTheGrossPriceOfSpecifiedOrder(1);
    http_response_code(200);
    echo json_encode(["order_id" => 1, "gross_price" => $gross_price, "currency" => "$"]);
}else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
