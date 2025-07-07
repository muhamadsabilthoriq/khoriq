<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar semua genre.
     */
    public function index()
    {
        $genres = Genre::latest()->paginate(10);
        return view('genre.index', compact('genres'));
    }

    /**
     * Menampilkan form untuk menambahkan genre baru.
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Menyimpan genre baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres',
        ]);

        Genre::create($request->only('name'));

        return redirect()->route('genre.index')->with('success', '✅ Genre berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit genre.
     */
    public function edit(Genre $genre)
    {
        return view('genre.edit', compact('genre'));
    }

    /**
     * Memperbarui data genre di database.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,' . $genre->id,
        ]);

        $genre->update($request->only('name'));

        return redirect()->route('genre.index')->with('success', '✅ Genre berhasil diperbarui.');
    }

    /**
     * Menghapus genre dari database.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genre.index')->with('success', '🗑️ Genre berhasil dihapus.');
    }
}
