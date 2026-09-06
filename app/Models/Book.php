<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table(timestamps: false)]
#[Hidden(['id'])]
#[Fillable(['title', 'publication_year', 'count'])]
class Book extends Model
{
    use HasFactory;

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
