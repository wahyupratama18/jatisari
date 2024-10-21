<?php

namespace App\Action;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BorrowCollection;
use App\Http\Resources\MemberCollection;
use App\Models\Book;
use App\Models\BookMember;
use App\Models\Member;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class Paginate
{
    protected array $where = ['book.index' => 'title', 'member.index' => 'name'];

    protected array $borrowed = ['borrow.index', 'returned.index'];

    public function handle(Request $request, Closure $next)
    {
        $paginated = (match ($name = $request->route()->getName()) {
            'book.index' => Book::query(),
            'member.index' => Member::query(),
            'borrow.index', 'returned.index' => BookMember::query(),
        })->when(
            $request->search && ! in_array($name, $this->borrowed),
            fn (Builder $query) => $query->where($this->where[$name], 'like', "%$request->search%")
        )->when(
            $name == 'borrow.index',
            fn (Builder $query) => $query->whereNull('actual_returned_at')
                ->oldest('expected_returned_at')
        )->when(
            $name == 'returned.index',
            fn (Builder $query) => $query->latest('actual_returned_at')
                ->whereNotNull('actual_returned_at')
                ->where('actual_returned_at', '>=', now()->subMonth())
        )->when(
            in_array($name, $this->borrowed),
            fn (Builder $query) => $query
                ->with(['book', 'member'])
                ->when(
                    $request->search,
                    fn (Builder $query) => $query->whereHas(
                        'book',
                        fn (Builder $query) => $query->whereAny(
                            ['title', 'identifier'],
                            'like',
                            "%$request->search%"
                        )
                    )->orWhereHas(
                        'member',
                        fn (Builder $query) => $query->whereAny(
                            ['name', 'identifier'],
                            'like',
                            "%$request->search%"
                        )
                    )
                )
        )->latest()->paginate(10);

        return $next(match ($name) {
            'book.index' => new BookCollection($paginated),
            'member.index' => new MemberCollection($paginated),
            'borrow.index', 'returned.index' => new BorrowCollection($paginated),
        });
    }
}
