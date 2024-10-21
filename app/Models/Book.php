<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier',
        'title',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'state' => BookStatus::class,
        ];
    }

    /**
     * The members that belong to the Book
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)->withPivot(['expected_returned_at', 'actual_returned_at']);
    }
}
