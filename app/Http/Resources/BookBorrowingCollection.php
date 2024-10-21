<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookBorrowingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn ($book) => [
                'id' => $book->id,
                'identifier' => $book->identifier,
                'title' => $book->title,
                'expected_returned_at' => Carbon::parse($book->pivot->expected_returned_at)
                    ->translatedFormat('j F Y'),
                'actual_returned_at' => Carbon::parse($book->pivot->actual_returned_at)
                    ->translatedFormat('j F Y H:i'),
            ]),
        ];
    }
}
