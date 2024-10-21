<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookMember extends Model
{
    use HasFactory;

    protected $table = 'book_member';

    protected $fillable = [
        'book_id',
        'member_id',
        'expected_returned_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expected_returned_at' => 'date',
            'actual_returned_at' => 'datetime',
        ];
    }

    /**
     * Get the member that owns the BookMember
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the book that owns the BookMember
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
