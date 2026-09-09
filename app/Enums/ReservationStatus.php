<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Reserved = 'reserved';
    case Returned = 'returned';
    case ReturnedLate = 'returned_late';
    case Overdue = 'overdue';

    public function label(): string
    {
        return match ($this) {
            self::Returned => 'Returned',
            self::ReturnedLate => 'Returned Late',
            self::Overdue => 'Overdue',
            default => 'Reserved',
        };
    }
}
