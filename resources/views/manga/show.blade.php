@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    {{-- Header Manga --}}
    <div class="flex flex-col md:flex-row gap-6 items-start">
        {{-- Gambar cover (jika ada) --}}
        @if($manga->cover_image)
        <div class="w-full md:w-1/3">
            <img src="{{ asset('storage/' . $manga->cover_image) }}" alt="{{ $manga->title }}" class="rounded-lg shadow-md w-full object-cover">
        </div>
        @endif

        {{-- Info Manga --}}
        <div class="w-full md:w-2/3">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $manga->title }}</h1>
            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line mb-4">{{ $manga->description }}</p>

            @auth
                <a href="{{ route('chapter.create', $manga->id) }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm font-medium">
                    + Tambah Chapter
                </a>
            @endauth
        </div>
    </div>

    {{-- Daftar Chapter --}}
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Daftar Chapter</h2>

        @forelse($manga->chapters->sortByDesc('number') as $chapter)
            <div class="flex justify-between items-center p-4 bg-white dark:bg-gray-900 rounded-lg shadow mb-2">
                <div>
                    <p class="font-semibold text-gray-800 dark:text-white">Chapter {{ $chapter->number }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $chapter->title }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('chapter.show', ['manga' => $manga->id, 'chapter' => $chapter->id]) }}"
                       class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded">
                        📖 Baca
                    </a>

                    @auth
                        <a href="{{ route('chapter.edit', ['manga' => $manga->id, 'chapter' => $chapter->id]) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('chapter.destroy', ['manga' => $manga->id, 'chapter' => $chapter->id]) }}"
                              method="POST" onsubmit="return confirm('Yakin ingin menghapus chapter ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400">Belum ada chapter untuk manga ini.</p>
        @endforelse
    </div>
</div>
@endsection
