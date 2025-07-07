@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                {{-- Judul Form --}}
                <h2 class="text-2xl font-bold mb-6">
                    Tambah Halaman - {{ $chapter->title }}
                </h2>

                {{-- Form Tambah Halaman --}}
                <form action="{{ route('page.store', $chapter->id) }}"
                      method="POST" enctype="multipart/form-data"
                      class="space-y-6">
                    @csrf

                    {{-- Nomor Halaman --}}
                    <div>
                        <label for="page_number" class="block text-sm font-medium mb-1">
                            Nomor Halaman
                        </label>
                        <input type="number" name="page_number" id="page_number"
                               value="{{ old('page_number') }}"
                               class="w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 focus:ring focus:ring-blue-500"
                               required>
                        @error('page_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Gambar --}}
                    <div>
                        <label for="image" class="block text-sm font-medium mb-1">
                            Gambar Halaman
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" required
                               class="w-full text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-md transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
