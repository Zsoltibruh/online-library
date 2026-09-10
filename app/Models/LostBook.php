<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(timestamps: false)]
#[Hidden(['id'])]
#[Fillable(['reservation_id', 'logger', 'log_date'])]
class LostBook extends Model
{
    use HasFactory;

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
