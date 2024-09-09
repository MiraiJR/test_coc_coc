<?php

declare(strict_types=1);

namespace app\order\domain;

use PHPUnit\Framework\TestCase;

class OrderedItemTest extends TestCase
{
    public function testGetArea()
    {
        $ordered_item = new OrderedItem(1.1, 2.4, 3.2, 3.4, 4.2);
        $expected_result = 45.7;
        $actual_result = $ordered_item->getArea();
        $this->assertEquals($expected_result, $actual_result);
    }
}
