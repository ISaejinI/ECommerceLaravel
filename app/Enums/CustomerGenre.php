<?php

namespace App\Enums;

enum CustomerGenre: string{
    case FEMALE = 'female';
    case MALE = 'male';

    public function label(): string
    {
        return match ($this) {
            self::FEMALE => 'Femme',
            self::MALE => 'Homme',
        };
    }
}