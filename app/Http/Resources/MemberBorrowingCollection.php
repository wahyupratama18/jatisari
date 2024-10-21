<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberBorrowingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn ($member) => [
                'id' => $member->id,
                'identifier' => $member->identifier,
                'name' => $member->name,
                'expected_returned_at' => Carbon::parse($member->pivot->expected_returned_at)
                    ->translatedFormat('j F Y'),
                'actual_returned_at' => Carbon::parse($member->pivot->actual_returned_at)
                    ->translatedFormat('j F Y H:i'),
            ]),
        ];
    }
}
