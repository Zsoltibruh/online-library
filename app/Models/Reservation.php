<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Override;

#[Table(timestamps: false)]
#[Hidden(['id'])]
class Reservation extends Model
{
    use HasFactory;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'return_date' => 'datetime',
            'actual_return_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function returnedOnTime(): bool
    {
        if ($this->actual_return_date === null) {
            return true;
        }

        return $this->return_date->diffInMonths($this->actual_return_date) < 0;
    }

    public function isExpired(): bool
    {
        return $this->return_date->isPast() && $this->actual_return_date === null;
    }
}
