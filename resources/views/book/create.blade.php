<x-app-layout>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Tambahkan buku') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Tambah koleksi buku perpustakaan.') }}
                            </p>
                        </header>
                    
                        <form method="post" action="{{ route('book.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="identifier" :value="__('ID')" required />
                                <x-text-input id="identifier" name="identifier" type="text" class="mt-1 block w-full" :value="old('identifier')" required autofocus autocomplete="identifier" />
                                <x-input-error class="mt-2" :messages="$errors->get('identifier')" />
                            </div>

                            <div>
                                <x-input-label for="title" :value="__('Judul Buku')" required />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                    
                            <div class="flex books-center gap-4">
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
