<?php declare(strict_types=1);

namespace Domain\Order;

use Domain\Enumerated;

final class OrderPaymentStatus
{
    use Enumerated;

    private const OPEN = 'open';
    private const PAID = 'paid';
    private const CHARGEBACK = 'chargeback';
    private const REFUND = 'refund';
    private const INKASSO = 'inkasso';

    public static function open(): self
    {
        return self::get(self::OPEN);
    }

    public static function paid(): self
    {
        return self::get(self::PAID);
    }

    public static function chargeback(): self
    {
        return self::get(self::CHARGEBACK);
    }

    public static function refund(): self
    {
        return self::get(self::REFUND);
    }

    public static function inkasso(): self
    {
        return self::get(self::INKASSO);
    }
}