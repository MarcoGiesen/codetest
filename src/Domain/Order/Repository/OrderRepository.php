<?php

namespace Domain\Order\Repository;

use Domain\Database;
use Domain\Order\Order;

class OrderRepository
{
    private Database $database;
    private string $table = 'orders';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return Order[]
     */
    public function fetchAll(): array
    {
        $result = $this->database->fetch('select * from orders;');
        $orders = [];

        foreach ($result as $item) {
            $orders[] = Order::fromArray($item);
        }

        return $orders;
    }

    public function fetchOrdersCountGroupedByCurrency(): array
    {
        return $this->database->fetch('select currency, count(*) from orders group by currency;', MYSQLI_NUM);
    }
}
