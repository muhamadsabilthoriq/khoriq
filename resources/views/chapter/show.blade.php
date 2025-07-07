@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                {{-- Header dan Tombol --}}
                <div class="flex flex-wrap justify-between items-start mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold">
                            {{ $manga->title }} - {{ $chapter->title }}
                        </h2>

                        {{-- Tombol Baca dari Awal --}}
                        @if ($pages->count())
                            <a href="{{ route('page.read', ['chapter' => $chapter->id, 'page' => $pages->first()->id]) }}"
                               class="mt-2 inline-block text-blue-600 dark:text-blue-400 text-sm hover:underline">
                                📘 Baca Chapter dari Awal
                            </a>
                        @endif
                    </div>

                    {{-- Tombol Tambah Halaman --}}
                    @auth
                        <a href="{{ route('page.create', $chapter->id) }}"
                           class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            + Tambah Halaman
                        </a>
                    @endauth
                </div>

                {{-- Daftar Halaman --}}
                @if ($pages->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach ($pages as $page)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded shadow">
                                {{-- Gambar Halaman --}}
                                <a href="{{ route('page.read', ['chapter' => $chapter->id, 'page' => $page->id]) }}">
                                    <img src="{{ asset('storage/' . $page->image) }}"
                                         alt="Halaman {{ $page->page_number }}"
                                         class="w-full h-60 object-contain rounded-lg mb-3 hover:opacity-90 transition">
                                </a>

                                {{-- Info Halaman --}}
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                                    Halaman {{ $page->page_number }}
                                </p>

                                {{-- Tombol Aksi --}}
                                <div class="flex items-center gap-4 text-sm flex-wrap">
                                    <a href="{{ route('page.read', ['chapter' => $chapter->id, 'page' => $page->id]) }}"
                                       class="text-blue-500 hover:underline">
                                        📖 Baca
                                    </a>

                                    @auth
                                        <a href="{{ route('page.edit', ['chapter' => $chapter->id, 'page' => $page->id]) }}"
                                           class="text-yellow-500 hover:underline">
                                            ✏️ Edit
                                        </a>

                                        <form action="{{ route('page.destroy', ['chapter' => $chapter->id, 'page' => $page->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic text-center py-8">
                        Halaman belum tersedia untuk chapter ini.
                    </p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
