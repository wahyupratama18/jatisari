<?php

namespace App\Http\Controllers;

use App\Action\Paginate;
use App\Http\Requests\StoreBookMemberRequest;
use App\Http\Requests\UpdateBookMemberRequest;
use App\Models\Book;
use App\Models\BookMember;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class BookMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('borrow.index', [
            'borrows' => Pipeline::send($request)->through([
                Paginate::class,
            ])->thenReturn(),
            'columns' => collect([
                ['name' => 'ID Buku', 'field' => 'book_unique'],
                ['name' => 'Judul Buku', 'field' => 'book_title'],
                ['name' => 'ID Member', 'field' => 'member_unique'],
                ['name' => 'Nama', 'field' => 'member_title'],
                ['name' => 'Ekspektasi dikembalikan', 'field' => 'expected_returned_at'],
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('borrow.create', [
            'books' => Book::query()->where('state', 1)->get(),
            'members' => Member::query()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookMemberRequest $request): RedirectResponse
    {
        BookMember::query()->create($request->validated());

        return redirect()->route('borrow.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookMember $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookMember $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookMemberRequest $request, BookMember $borrow): RedirectResponse
    {
        $borrow->actual_returned_at = now();
        $borrow->save();

        return redirect()->route('borrow.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookMember $borrow)
    {
        //
    }
}
