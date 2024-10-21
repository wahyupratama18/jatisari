<x-app-layout>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pinjam buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Pinjam buku') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Lakukan peminjaman buku.') }}
                            </p>
                        </header>
                    
                        <form method="post" action="{{ route('borrow.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="member_id" :value="__('Member')" required />
                                <x-select id="member_id" name="member_id" type="text" class="mt-1 block w-full" :value="old('member_id')" required autofocus autocomplete="member_id">
                                    @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->identifier.' - '.$member->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('member_id')" />
                                </div>
                                
                            <div>
                                <x-input-label for="book_id" :value="__('Buku Dipinjam')" required />
                                <x-select id="book_id" name="book_id" type="text" class="mt-1 block w-full" :value="old('book_id')" required autofocus autocomplete="book_id">
                                    @foreach ($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->identifier.' - '.$book->title }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('book_id')" />
                            </div>

                            <div>
                                <x-input-label for="expected_returned_at" :value="__('Tanggal Kembali')" required />
                                <x-text-input id="expected_returned_at" name="expected_returned_at" type="date" class="mt-1 block w-full" :value="old('expected_returned_at', $tomorrow = now()->addDay()->toDateString())" required autofocus autocomplete="expected_returned_at" :min="$tomorrow" />
                                <x-input-error class="mt-2" :messages="$errors->get('expected_returned_at')" />
                            </div>
                    
                            <div class="flex borrows-center gap-4">
                                <x-primary-button>
                                    {{ __('Simpan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
