<?php

namespace App\Http\Controllers;

use App\Action\Paginate;
use App\Models\BookMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class ReturnedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('returned.index', [
            'returns' => Pipeline::send($request)->through([
                Paginate::class,
            ])->thenReturn(),
            'columns' => collect([
                ['name' => 'ID Buku', 'field' => 'book_unique'],
                ['name' => 'Judul Buku', 'field' => 'book_title'],
                ['name' => 'ID Member', 'field' => 'member_unique'],
                ['name' => 'Nama', 'field' => 'member_title'],
                ['name' => 'Tanggal kembali', 'field' => 'actual_returned_at'],
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookMember $bookMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookMember $bookMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookMember $bookMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookMember $bookMember)
    {
        //
    }
}
