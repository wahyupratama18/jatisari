<?php

namespace App\Observers;

use App\Models\Member;
use Illuminate\Support\Str;

class MemberObserver
{
    /**
     * Handle the Member "creating" event.
     */
    public function creating(Member $member): void
    {
        $member->identifier = Str::upper(uniqid('M-'));
    }

    /**
     * Handle the Member "updated" event.
     */
    public function updated(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "deleted" event.
     */
    public function deleted(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "restored" event.
     */
    public function restored(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "force deleted" event.
     */
    public function forceDeleted(Member $member): void
    {
        //
    }
}
