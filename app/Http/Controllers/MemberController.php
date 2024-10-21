<?php

namespace App\Http\Controllers;

use App\Action\Paginate;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\BookBorrowingCollection;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('member.index', [
            'members' => Pipeline::send($request)->through([
                Paginate::class,
            ])->thenReturn(),
            'columns' => collect([
                ['name' => 'ID', 'field' => 'identifier'],
                ['name' => 'Nama', 'field' => 'name'],
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        Member::query()->create($request->validated());

        return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('member.show', [
            'member' => $member,
            'books' => new BookBorrowingCollection(
                $member->books()
                    ->wherePivot('expected_returned_at', '>=', now()->subYear())
                    ->latest('book_member.expected_returned_at')
                    ->paginate(15)
            ),
            'columns' => collect([
                ['name' => 'ID Buku', 'field' => 'identifier'],
                ['name' => 'Judul', 'field' => 'title'],
                ['name' => 'Ekspektasi dikembalikan', 'field' => 'expected_returned_at'],
                ['name' => 'Tanggal kembali', 'field' => 'actual_returned_at'],
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member): View
    {
        return view('member.edit', ['member' => $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        $member->update($request->validated());

        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('member.index');
    }
}
