<?php

declare(strict_types=1);

namespace app\order\infrastructure\persistence;

use app\order\domain\Order;
use app\order\domain\OrderedItem;
use app\order\infrastructure\mapping\OrderMapping;
use phpmock\Mock;
use PHPUnit\Framework\TestCase;
use phpmock\MockBuilder;

class OrderRepositoryTest extends TestCase
{
    private OrderRepository $orderRepository;
    const NAME_SPACE = 'app\order\infrastructure\persistence';

    private ?Mock $fileExistsMock = null;
    private ?Mock $fileGetContentsMock = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = new OrderRepository(new OrderMapping());
    }

    public function tearDown(): void
    {
        if ($this->fileExistsMock) {
            $this->fileExistsMock->disable();
        }

        if ($this->fileGetContentsMock) {
            $this->fileGetContentsMock->disable();
        }
    }

    public function testLoadOrderById_success()
    {
        $this->fileExistsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_exists")
            ->setFunction(
                function () {
                    return true;
                }
            )
            ->build()
        ;
        $this->fileGetContentsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_get_contents")
            ->setFunction(
                function () {
                    return '
                    [
                        {
                            "amazon_price": 1,
                            "weight": 1,
                            "height": 1,
                            "width": 1,
                            "depth": 1
                        }
                    ]';
                }
            )
            ->build()
        ;
        $this->fileExistsMock->enable();
        $this->fileGetContentsMock->enable();

        $expected_result = new Order([new OrderedItem(1, 1, 1, 1, 1)]);
        $actual_result = $this->orderRepository->loadOrderById(1);

        $this->assertEquals($expected_result, $actual_result);
    }

    public function testLoadOrderById_notExistedFile()
    {
        $this->fileExistsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_exists")
            ->setFunction(
                function () {
                    return false;
                }
            )
            ->build()
        ;
        $this->fileExistsMock->enable();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Order not found");

        $this->orderRepository->loadOrderById(1);
    }

    public function testLoadOrderById_canNotReadFileContent()
    {
        $this->fileExistsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_exists")
            ->setFunction(
                function () {
                    return true;
                }
            )
            ->build()
        ;
        $this->fileGetContentsMock = (new MockBuilder())
            ->setNamespace(self::NAME_SPACE)
            ->setName("file_get_contents")
            ->setFunction(
                function () {
                    return false;
                }
            )
            ->build()
        ;
        $this->fileExistsMock->enable();
        $this->fileGetContentsMock->enable();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Order not found");

        $this->orderRepository->loadOrderById(1);
    }
}
