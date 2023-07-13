<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div> --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('bukus.update', $buku) }}" class="">
                        @csrf
                        @method('patch')
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                :value="old('name', $buku->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Penulis')" />
                            <x-text-input id="author" name="author" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="author" :value="old('author')" />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Tahun Rilis')" />
                            <x-text-input id="year" name="year" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="year" :value="old('year')" />
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Salinan Asli')" />
                            <x-text-input id="copies_in_circulation" name="copies_in_circulation" type="text" class="block w-full mt-1" required
                                autofocus autocomplete="copies_in_circulation" :value="old('copies_in_circulation')" />
                            <x-input-error class="mt-2" :messages="$errors->get('copies_in_circulation')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('bukus.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
