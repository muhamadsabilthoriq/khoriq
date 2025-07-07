@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-white">➕ Tambah Genre</h2>

    <form action="{{ route('genre.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 dark:text-white">Nama Genre</label>
            <input type="text" name="name" id="name" class="w-full mt-1 p-2 rounded border @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>

            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('genre.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
