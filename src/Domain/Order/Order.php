<?php

namespace Domain\Order;

class Order
{
    // currently public, just for demonstration, normally private with getters -> otherwise the private constructor would be useless
    public int $id;
    public int $userId;
    public int $sumTotal;
    public int $bonus;
    public string $vatRate;
    public OrderPaymentStatus $paymentStatus;
    public string $holdStatus;
    public string $currency;
    public \DateTimeImmutable $createdAt;

    private function __construct()
    {
    }

    public function isUnpaid(): int
    {
        // could use database query to get this number as well, which would be bette for performance
        return $this->paymentStatus === OrderPaymentStatus::open();
    }

    public function isPaid(): int
    {
        return $this->paymentStatus === OrderPaymentStatus::paid();
    }

    public static function fromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['id'];
        $self->userId = $data['user_id'];
        $self->sumTotal = $data['sumtotal'];
        $self->bonus = $data['bonus'];
        $self->vatRate = $data['vatrate'];
        $self->paymentStatus = OrderPaymentStatus::fromString($data['payment_status']);
        $self->holdStatus = $data['hold_status'];
        $self->currency = $data['currency'];
        $self->createdAt = new \DateTimeImmutable($data['created_at']);

        return $self;
    }
}
