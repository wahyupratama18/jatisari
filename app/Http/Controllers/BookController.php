<?php

namespace App\Http\Controllers;

use App\Action\Paginate;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\MemberBorrowingCollection;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('book.index', [
            'books' => Pipeline::send($request)->through([
                Paginate::class,
            ])->thenReturn(),
            'columns' => collect([
                ['name' => 'ID', 'field' => 'identifier'],
                ['name' => 'Judul buku', 'field' => 'title'],
                ['name' => 'Status buku', 'field' => 'state'],
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::query()->create($request->validated());

        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('book.show', [
            'book' => $book,
            'members' => new MemberBorrowingCollection(
                $book->members()
                    ->wherePivot('expected_returned_at', '>=', now()->subYear())
                    ->latest('book_member.expected_returned_at')
                    ->paginate(15)
            ),
            'columns' => collect([
                ['name' => 'ID peminjam', 'field' => 'identifier'],
                ['name' => 'Nama', 'field' => 'name'],
                ['name' => 'Ekspektasi dikembalikan', 'field' => 'expected_returned_at'],
                ['name' => 'Tanggal kembali', 'field' => 'actual_returned_at'],
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
    {
        return view('book.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('book.index');
    }
}
