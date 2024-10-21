<x-app-layout>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Detail buku') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Informasi koleksi buku.') }}
                            </p>
                        </header>
                    
                        <div class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="identifier" :value="__('ID')" />
                                <x-text-input id="identifier" name="identifier" type="text" class="mt-1 block w-full" :value="$book->identifier" readonly />
                            </div>

                            <div>
                                <x-input-label for="title" :value="__('Judul Buku')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="$book->title" readonly />
                            </div>

                            <div>
                                <x-input-label for="state" :value="__('Status')" />
                                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="$book->state->name" readonly />
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <h2 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail peminjaman') }}
            </h2>

            <x-table :columns="$columns" :rows="$members" />

            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
