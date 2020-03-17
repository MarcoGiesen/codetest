<?php

namespace Domain\Order;


class Statistic
{
    /**
     * @var Order[]
     */
    private array $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public function countUnpaid(): int
    {
        $unpaid = 0;

        foreach ($this->orders as $order) {
            if ($order->isUnpaid()) {
                $unpaid++;
            }
        }

        return $unpaid;
    }

    public function countPaid(): int
    {
        $paid = 0;

        foreach ($this->orders as $order) {
            if ($order->isPaid()) {
                $paid++;
            }
        }

        return $paid;
    }
}