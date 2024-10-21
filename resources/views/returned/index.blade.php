<x-app-layout>
    <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                {{-- Create --}}
                {{-- <div class="flex justify-end mb-4 gap-4">
                    <a href="{{ route('return.create') }}">
                        <x-primary-button>
                            {{ __('Tambahkan') }}
                        </x-primary-button>
                    </a>
                </div> --}}

                <x-search />

                <x-table :columns="$columns" :rows="$returns" />

                {{ $returns->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
