<?php

namespace App\Http\Resources;

use App\Models\BookMember;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BorrowCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn (BookMember $bookMember) => [
                'id' => $bookMember->id,
                'book_unique' => $bookMember->book->identifier,
                'book_title' => $bookMember->book->title,
                'member_unique' => $bookMember->member->identifier,
                'member_title' => $bookMember->member->name,
                'expected_returned_at' => $bookMember->expected_returned_at->translatedFormat('j F Y'),
                'actual_returned_at' => $bookMember->actual_returned_at?->translatedFormat('j F Y H:i'),
            ]),
        ];
    }
}
