<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

#[Table(timestamps: false)]
#[Hidden(['id'])]
#[Fillable(['book_id', 'user_id', 'reservation_date', 'due_date', 'return_date', 'status'])]
class Reservation extends Model
{
    use HasFactory;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function lostBooks(): HasMany
    {
        return $this->hasMany(LostBook::class);
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'reservation_date' => 'datetime',
            'due_date' => 'datetime',
            'return_date' => 'datetime',
            'status' => ReservationStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function canSendReturnNotice(): bool
    {
        return $this->status === ReservationStatus::Overdue;
    }

    public function canReturn(): bool
    {
        return $this->return_date === null;
    }

    public function returnedLate(): bool
    {
        return $this->due_date->diffInMonths($this->return_date) > 0;
    }

    public function isExpired(): bool
    {
        return $this->return_date === null &&
            $this->status === ReservationStatus::Reserved
            && now()->diffInMonths($this->due_date) < 0;
    }
}
