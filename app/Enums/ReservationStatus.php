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

    public function textColor(): string
    {
        return match ($this) {
            self::Returned => 'text-success',
            self::ReturnedLate => 'text-warning',
            self::Overdue => 'text-error',
            default => 'text-info',
        };
    }
}
