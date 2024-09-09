<?php

declare(strict_types=1);

require_once "../../prepend.php";

use app\order\infrastructure\web\in\OrderController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_controller = new OrderController();

    $raw_post_data = file_get_contents('php://input');
    $post_data = json_decode($raw_post_data, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid content type!"]);
        exit;
    }

    $order_id = $post_data['order_id'];
    $gross_price = $order_controller->handleCalculateTheGrossPriceOfSpecifiedOrder($order_id);
    http_response_code(200);
    echo json_encode(["order_id" => $order_id, "gross_price" => $gross_price, "currency" => "$"]);
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
