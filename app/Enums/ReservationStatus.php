<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Reserved = 'reserved';
    case Returned = 'returned';
    case ReturnedLate = 'returned_late';
    case Lost = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::Returned => 'Returned',
            self::ReturnedLate => 'Returned Late',
            self::Lost => 'Lost',
            default => 'Reserved',
        };
    }
}
