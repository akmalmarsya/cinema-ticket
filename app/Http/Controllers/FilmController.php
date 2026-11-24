<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FilmController extends Controller
{
    // Menampilkan daftar film
    public function index(Request $request): View
    {
        $films = Film::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('genre', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.films.index', compact('films'));
    }

    // Form tambah film
    public function create(): View
    {
        return view('admin.films.create');
    }

    // Menyimpan film baru
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'genre' => 'required|string|max:100',
            'durasi_menit' => 'required|integer|min:1|max:65535',
            'rating_usia' => 'required|in:SU,13+,17+,21+',
            'sinopsis' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tayang,tidak_tayang',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')
                ->store('posters/films', 'public');
        }

        Film::create($data);

        return redirect()
            ->route('admin.films.index')
            ->with('success', 'Film berhasil ditambahkan.');
    }

    // Form edit film
    public function edit(Film $film): View
    {
        return view('admin.films.edit', compact('film'));
    }

    // Memperbarui film
    public function update(Request $request, Film $film): RedirectResponse
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'genre' => 'required|string|max:100',
            'durasi_menit' => 'required|integer|min:1|max:65535',
            'rating_usia' => 'required|in:SU,13+,17+,21+',
            'sinopsis' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tayang,tidak_tayang',
        ]);

        if ($request->hasFile('poster')) {
            $newPoster = $request->file('poster')
                ->store('posters/films', 'public');

            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }

            $data['poster'] = $newPoster;
        }

        $film->update($data);

        return redirect()
            ->route('admin.films.index')
            ->with('success', 'Data film berhasil diperbarui.');
    }

    // Menghapus film
    public function destroy(Film $film): RedirectResponse
    {
        // Film yang memiliki jadwal tidak boleh dihapus
        if ($film->jadwals()->exists()) {
            return redirect()
                ->route('admin.films.index')
                ->with('error', 'Film tidak dapat dihapus karena masih memiliki jadwal tayang.');
        }

        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }

        $film->delete();

        return redirect()
            ->route('admin.films.index')
            ->with('success', 'Film berhasil dihapus.');
    }
}