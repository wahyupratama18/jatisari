<x-app-layout>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Koleksi Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                {{-- Create --}}
                <div class="flex justify-end mb-4 gap-4">
                    <a href="{{ route('book.create') }}">
                        <x-primary-button>
                            {{ __('Tambahkan') }}
                        </x-primary-button>
                    </a>
                </div>

                <x-search />

                <x-table :columns="$columns" :rows="$books">
                    {{-- custom name slots will receive data in JavaScript with object key "row" --}}
                    <x-slot name="tableActions">
                        <div class="flex md:flex-wrap gap-4">
                            <a :href="`{{ route('book.show', ':id') }}`.replace(':id', row.id)">
                                <x-secondary-button>
                                    {{ __('Lihat Detail') }}
                                </x-secondary-button>
                            </a>
                            
                            <a :href="`{{ route('book.edit', ':id') }}`.replace(':id', row.id)">
                                <x-primary-button>
                                    {{ __('Ubah') }}
                                </x-primary-button>
                            </a>

                            <form method="POST" :action="`{{ route('book.destroy', ':id') }}`.replace(':id', row.id)">
                                @method('DELETE')
                                @csrf
                                <x-danger-button>
                                    {{ __('Hapus') }}
                                </x-danger-button>
                            </form>
                        </div>
                    </x-slot>
                </x-table>

                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
