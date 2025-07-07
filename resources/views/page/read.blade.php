@extends('layouts.app')

@section('content')
<div class="py-10 min-h-screen bg-gray-900 text-white">
    <div class="max-w-3xl mx-auto px-4 text-center">

        {{-- Judul Manga dan Chapter --}}
        <h2 class="text-2xl sm:text-3xl font-bold mb-2">
            {{ $chapter->manga->title }} - {{ $chapter->title }}
        </h2>

        {{-- Progress Halaman --}}
        <p class="text-sm text-gray-400 mb-6">
            Halaman {{ $page->page_number }} dari {{ $chapter->pages->count() }}
        </p>

        {{-- Gambar Halaman --}}
        <div class="mb-8">
            <img src="{{ asset('storage/' . $page->image) }}"
                 alt="Halaman {{ $page->page_number }}"
                 class="w-full rounded-lg shadow-md max-h-[80vh] object-contain mx-auto border border-gray-700 transition">
        </div>

        {{-- Navigasi Halaman --}}
        <div class="flex justify-between gap-4 mb-8">
            @if ($prev)
                <a href="{{ route('page.read', ['chapter' => $chapter->id, 'page' => $prev->id]) }}"
                   class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition text-left">
                    ← Sebelumnya
                </a>
            @else
                <div class="flex-1 text-left text-gray-500">← Awal</div>
            @endif

            @if ($next)
                <a href="{{ route('page.read', ['chapter' => $chapter->id, 'page' => $next->id]) }}"
                   class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition text-right">
                    Selanjutnya →
                </a>
            @else
                <div class="flex-1 text-right text-gray-500">Akhir →</div>
            @endif
        </div>

        {{-- Tombol Kembali ke Chapter --}}
        <a href="{{ route('chapter.show', ['manga' => $chapter->manga->id, 'chapter' => $chapter->id]) }}"
           class="inline-block mt-2 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition text-sm">
            ⬅️ Kembali ke Daftar Halaman
        </a>
    </div>
</div>
@endsection
