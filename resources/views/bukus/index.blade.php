<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        @can('admin')
                        <div>
                            <x-create-button href="{{ route('bukus.create') }}" />
                        </div>
                        @endcan
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Penulis
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kategori Buku
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tahun Rilis
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Salinan Asli
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Salinan Tersedia
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bukus as $buku)
                                <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ $buku->url }}" class="hover:underline">{{ $buku->title }}</a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $buku->author }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if ($buku->category_id)
                                    {{ $buku->category->title }}
                                    @endif
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-900">
                                        {{ $buku->year }}
                                    </td>
                                    
                                </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-900">
                                        @if ($buku->copies_in_circulation < 10)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                {{ $buku->copies_in_circulation }}
                                            </span>
                                        @elseif($buku->copies_in_circulation < 20)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-orange-800 bg-orange-100 rounded-full">
                                                {{ $buku->copies_in_circulation }}
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                {{ $buku->copies_in_circulation }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-900">
                                        @if ($buku->availableCopies() < 10)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                {{ $buku->availableCopies() }}
                                            </span>
                                        @elseif($buku->availableCopies() < 20)
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-orange-800 bg-orange-100 rounded-full">
                                                {{ $buku->availableCopies() }}
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                {{ $buku->availableCopies() }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-900">
                                        @if ($buku->canBeBorrowed())
                                            <a href="{{ route('peminjamen.create', ['buku' => $buku->id]) }}" class="text-indigo-600 hover:underline">Pinjam Buku</a>
                                        @else
                                            <p class="text-red-600">No copies available to borrow</p>
                                        @endif
                                        <form action="{{ route('bukus.edit', $buku) }}" method="Post">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="text-red-600 dark:text-red-400">
                                                    Edit
                                                </button>
                                        </form>
                                        <form action="{{ route('bukus.destroy', $buku) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400">
                                                    Delete
                                                </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" colspan="6" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
