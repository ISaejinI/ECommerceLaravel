<?php

namespace App\Enums;

enum OrderStatus: string{
    case PAID = 'paid';
    case READY = 'ready';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';

    public function label(): string
    {
        return match ($this) {
            self::PAID => 'Payée',
            self::READY => 'Prête à être expédiée',
            self::SHIPPED => 'Expédiée',
            self::DELIVERED => 'Livrée',
        };
    }
}