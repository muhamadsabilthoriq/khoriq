<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index(Request $request)
    {
        $query = Manga::with('genres')->withCount('chapters')->latest();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $mangas = $query->paginate(12);

        return view('home', compact('mangas'));
    }

    public function show($id)
    {
        $manga = Manga::with('genres', 'chapters')->findOrFail($id);
        return view('manga.show', compact('manga'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('manga.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $manga = Manga::create($data);
        $manga->genres()->attach($request->genres); // relasi many-to-many

        return redirect()->route('home')->with('success', '✅ Manga berhasil ditambahkan.');
    }

    public function edit(Manga $manga)
    {
        $genres = Genre::all();
        $manga->load('genres');

        return view('manga.edit', compact('manga', 'genres'));
    }

    public function update(Request $request, Manga $manga)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('cover_image')) {
            if ($manga->cover_image && Storage::exists('public/' . $manga->cover_image)) {
                Storage::delete('public/' . $manga->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $manga->update($data);
        $manga->genres()->sync($request->genres); // perbarui relasi genre

        return redirect()->route('home')->with('success', '✅ Manga berhasil diperbarui.');
    }

    public function destroy(Manga $manga)
    {
        if ($manga->cover_image && Storage::exists('public/' . $manga->cover_image)) {
            Storage::delete('public/' . $manga->cover_image);
        }

        // Hapus relasi genre terlebih dahulu
        $manga->genres()->detach();

        $manga->delete();

        return redirect()->route('home')->with('success', '🗑️ Manga berhasil dihapus.');
    }
}
