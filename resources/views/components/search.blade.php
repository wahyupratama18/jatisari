<form method="GET" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg grid md:grid-cols-4 gap-4 mb-6 p-6">
    <div class="md:col-span-3">
        <x-input-label for="search" :value="__('Cari')" />
        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="old('search', request('search'))" autofocus autocomplete="search" />
        <x-input-error class="mt-2" :messages="$errors->get('search')" />
    </div>

    <div class="flex items-center justify-end">
        <x-primary-button>
            {{ __('Cari') }}
        </x-primary-button>
    </div>
</form>