@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Edit Manga</h2>

        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('manga.update', $manga->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div>
                <label for="title" class="block text-sm font-medium">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $manga->title) }}" required
                       class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">{{ old('description', $manga->description) }}</textarea>
            </div>

            {{-- Genre (multiple) --}}
            <div>
                <label for="genres" class="block text-sm font-medium">Genre</label>
                <select name="genres[]" id="genres" multiple
                        class="w-full p-2 rounded bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ (in_array($genre->id, old('genres', $manga->genres->pluck('id')->toArray()))) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-sm text-gray-500 dark:text-gray-300">* Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</small>
            </div>

            {{-- Cover Saat Ini --}}
            <div>
                <label class="block text-sm font-medium">Cover Saat Ini</label>
                @if ($manga->cover_image)
                    <img src="{{ asset('storage/' . $manga->cover_image) }}" alt="Cover" class="w-32 mb-2 rounded shadow">
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-300">Belum ada cover</p>
                @endif
            </div>

            {{-- Ganti Cover --}}
            <div>
                <label for="cover_image" class="block text-sm font-medium">Ganti Cover (opsional)</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*"
                       class="w-full text-sm text-gray-900 dark:text-white">
            </div>

            {{-- Tombol Submit --}}
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
