@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-white">📚 Daftar Genre</h2>

    <a href="{{ route('genre.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Genre</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white dark:bg-gray-800 shadow rounded">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="px-4 py-2 text-left">Nama Genre</th>
                <th class="px-4 py-2 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($genres as $genre)
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ $genre->name }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('genre.edit', $genre->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menghapus genre ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-4 py-4 text-center text-gray-600 dark:text-white">Belum ada genre.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $genres->links() }}
    </div>
</div>
@endsection
