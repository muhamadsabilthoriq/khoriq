<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Tampilkan form tambah halaman baru untuk suatu chapter.
     */
    public function create(Chapter $chapter): View
    {
        return view('page.create', compact('chapter'));
    }

    /**
     * Simpan halaman baru ke database dan upload gambar ke storage.
     */
    public function store(Request $request, Chapter $chapter): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'page_number' => 'required|integer|min:1',
        ]);

        $path = $validated['image']->store('pages', 'public');

        $chapter->pages()->create([
            'image' => $path,
            'page_number' => $validated['page_number'],
        ]);

        return redirect()->route('chapter.show', [
            'manga' => $chapter->manga_id,
            'chapter' => $chapter->id
        ])->with('success', 'Halaman berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit untuk halaman tertentu.
     */
    public function edit(Chapter $chapter, Page $page): View
    {
        $this->authorizePageBelongsToChapter($chapter, $page);

        return view('page.edit', compact('chapter', 'page'));
    }

    /**
     * Update data halaman dan gambar (jika diubah).
     */
    public function update(Request $request, Chapter $chapter, Page $page): RedirectResponse
    {
        $this->authorizePageBelongsToChapter($chapter, $page);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'page_number' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            if ($page->image && Storage::exists('public/' . $page->image)) {
                Storage::delete('public/' . $page->image);
            }

            $path = $request->file('image')->store('pages', 'public');
            $page->image = $path;
        }

        $page->page_number = $validated['page_number'];
        $page->save();

        return redirect()->route('chapter.show', [
            'manga' => $chapter->manga_id,
            'chapter' => $chapter->id
        ])->with('success', 'Halaman berhasil diperbarui.');
    }

    /**
     * Hapus halaman dari database dan hapus gambar dari storage.
     */
    public function destroy(Chapter $chapter, Page $page): RedirectResponse
    {
        $this->authorizePageBelongsToChapter($chapter, $page);

        if ($page->image && Storage::exists('public/' . $page->image)) {
            Storage::delete('public/' . $page->image);
        }

        $page->delete();

        return redirect()->route('chapter.show', [
            'manga' => $chapter->manga_id,
            'chapter' => $chapter->id
        ])->with('success', 'Halaman berhasil dihapus.');
    }

    /**
     * Tampilkan halaman baca satu per satu dengan tombol navigasi.
     */
    public function read(Chapter $chapter, Page $page): View
    {
        $this->authorizePageBelongsToChapter($chapter, $page);

        $pages = $chapter->pages()->orderBy('page_number')->get();
        $currentIndex = $pages->search(fn($p) => $p->id === $page->id);

        $prev = $currentIndex > 0 ? $pages[$currentIndex - 1] : null;
        $next = $currentIndex < $pages->count() - 1 ? $pages[$currentIndex + 1] : null;

        return view('page.read', compact('chapter', 'page', 'prev', 'next'));
    }

    /**
     * Pastikan halaman benar milik chapter terkait.
     */
    protected function authorizePageBelongsToChapter(Chapter $chapter, Page $page): void
    {
        if ($page->chapter_id !== $chapter->id) {
            abort(404, 'Halaman tidak ditemukan untuk chapter ini.');
        }
    }
}
