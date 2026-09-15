<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table(timestamps: false)]
#[Fillable(['name', 'birth'])]
#[Hidden(['id'])]
class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
