<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Chapter;
use App\Models\Page;

class ChapterController extends Controller
{
    /**
     * Tampilkan daftar chapter dari manga tertentu
     */
    public function index(Manga $manga)
    {
        $chapters = $manga->chapters()->latest()->get();
        return view('chapter.index', compact('manga', 'chapters'));
    }

    /**
     * Tampilkan form tambah chapter
     */
    public function create(Manga $manga)
    {
        return view('chapter.create', compact('manga'));
    }

    /**
     * Simpan chapter baru
     */
    public function store(Request $request, Manga $manga)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $manga->chapters()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('manga.show', $manga->id)->with('success', 'Chapter berhasil ditambahkan!');
    }

    /**
     * Tampilkan halaman-halaman dari suatu chapter
     */
    public function show(Manga $manga, Chapter $chapter)
    {
        $pages = Page::where('chapter_id', $chapter->id)->get();
        return view('chapter.show', compact('manga', 'chapter', 'pages'));
    }

    /**
     * Tampilkan form edit chapter
     */
    public function edit(Manga $manga, Chapter $chapter)
    {
        return view('chapter.edit', compact('manga', 'chapter'));
    }

    /**
     * Update data chapter
     */
    public function update(Request $request, Manga $manga, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $chapter->update([
            'title' => $request->title,
        ]);

        return redirect()->route('manga.show', $manga->id)->with('success', 'Chapter berhasil diperbarui!');
    }

    /**
     * Hapus chapter
     */
    public function destroy(Manga $manga, Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('manga.show', $manga->id)->with('success', 'Chapter berhasil dihapus!');
    }
}
