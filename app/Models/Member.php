<?php

namespace App\Models;

use App\Observers\MemberObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ObservedBy(MemberObserver::class)]
class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * The books that belong to the Member
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot(['expected_returned_at', 'actual_returned_at']);
    }
}
