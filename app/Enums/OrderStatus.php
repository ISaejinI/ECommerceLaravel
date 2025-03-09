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

    public static function selectOptions(): array
    {
        return array_combine(
            array_map(fn ($case) => $case->value, self::cases()),
            array_map(fn ($case) => $case->label(), self::cases())
        );
    }
}