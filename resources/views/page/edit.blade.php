@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                {{-- Judul --}}
                <h2 class="text-2xl font-bold mb-6">
                    Edit Halaman - {{ $chapter->title }} (Halaman {{ $page->page_number }})
                </h2>

                {{-- Form --}}
                <form action="{{ route('page.update', ['chapter' => $chapter->id, 'page' => $page->id]) }}"
                      method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nomor Halaman --}}
                    <div>
                        <label for="page_number" class="block text-sm font-medium mb-1">
                            Nomor Halaman
                        </label>
                        <input type="number" name="page_number" id="page_number"
                               value="{{ old('page_number', $page->page_number) }}"
                               class="w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 focus:ring focus:ring-blue-500"
                               required>
                        @error('page_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gambar Baru --}}
                    <div>
                        <label for="image" class="block text-sm font-medium mb-1">
                            Ganti Gambar (opsional)
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preview Gambar Lama --}}
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $page->image) }}" alt="Preview"
                             class="w-full rounded shadow-md">
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
