@extends('layouts.app')

@section('content')
<div class="py-8 max-w-6xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-white mb-6 text-center">📚 Daftar Manga</h1>

    {{-- Form Pencarian --}}
    <form action="{{ route('home') }}" method="GET" class="mb-8 max-w-md mx-auto">
        <div class="flex items-center gap-2">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Cari manga berdasarkan judul..."
                   class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring focus:border-blue-500">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Cari
            </button>
        </div>
    </form>

    {{-- Grid Manga --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($mangas as $manga)
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-md transition duration-300">
                <a href="{{ route('manga.show', $manga->id) }}">
                    {{-- Gambar Cover --}}
                    @if ($manga->cover_image)
                        <img src="{{ asset('storage/' . $manga->cover_image) }}"
                             alt="{{ $manga->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-500">
                            No Cover
                        </div>
                    @endif

                    {{-- Info Manga --}}
                    <div class="p-4">
                        <h5 class="text-lg font-semibold truncate text-gray-900 dark:text-white">
                            {{ $manga->title }}
                        </h5>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $manga->chapters_count ?? '0' }} Chapter
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-4 text-center text-white">
                Tidak ada manga ditemukan.
            </div>
        @endforelse
    </div>

    {{-- Paginasi --}}
    @if ($mangas instanceof \Illuminate\Pagination\LengthAwarePaginator && $mangas->hasPages())
        <div class="mt-6 text-center text-white">
            {{ $mangas->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
