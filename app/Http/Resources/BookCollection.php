<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn (BookResource $book) => [
                'id' => $book->id,
                'identifier' => $book->identifier,
                'title' => $book->title,
                'state' => $book->state->name,
            ]),
        ];
    }
}
