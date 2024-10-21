<?php

namespace App\Http\Requests;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => ['required', Rule::exists(Book::class, 'id')->where('state', 1)],
            'member_id' => ['required', Rule::exists(Member::class, 'id')],
            'expected_returned_at' => ['required', 'date', 'after_or_equal:tomorrow'],
        ];
    }
}
