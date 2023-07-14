@php use Carbon\Carbon; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="shadow-sm sm:rounded-lg">
            <div class="mx-auto sm:px-6 lg:px-8">
                @if (session()->has('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-7/12  text-center mx-auto m-5"
                        role="alert">
                        <span class="block sm:inline">{{ session()->get('status') }}</span>
                    </div>
                @endif

                @if ($peminjamen->count() > 0)
                    <table class="mx-auto">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    #
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Buku
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Nomor peminjaman
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Pengembalian
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach ($peminjamen as $peminjaman)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ $loop->index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $peminjaman->buku->title }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $peminjaman->number_borrowed }}
                                        </div>
                                    </td>

                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ Carbon::parse($peminjaman->return_date)->format('l jS F, Y') }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <a
                                            href="{{ route('peminjamen.terminate', ['peminjaman' => $peminjaman->id]) }}">Return
                                            book</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h1 class="m-6 text-xl font-semibold text-gray-900 text-center">belum ada buku yang dipinjam</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
