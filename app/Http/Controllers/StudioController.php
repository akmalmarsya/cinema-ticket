<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudioController extends Controller
{
    // Menampilkan daftar studio
    public function index(Request $request): View
    {
        $studios = Studio::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('tipe', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.studios.index', compact('studios'));
    }

    // Form tambah studio
    public function create(): View
    {
        return view('admin.studios.create');
    }

    // Menyimpan studio baru
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:studios,nama',
            'tipe' => 'required|string|max:50',
            'jumlah_baris' => 'required|integer|min:1|max:255',
            'kursi_per_baris' => 'required|integer|min:1|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Menghitung kapasitas otomatis
        $data['kapasitas'] =
            $data['jumlah_baris'] * $data['kursi_per_baris'];

        Studio::create($data);

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Studio berhasil ditambahkan.');
    }

    // Form edit studio
    public function edit(Studio $studio): View
    {
        return view('admin.studios.edit', compact('studio'));
    }

    // Memperbarui studio
    public function update(
        Request $request,
        Studio $studio
    ): RedirectResponse {

        $data = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('studios', 'nama')->ignore($studio->id),
            ],
            'tipe' => 'required|string|max:50',
            'jumlah_baris' => 'required|integer|min:1|max:255',
            'kursi_per_baris' => 'required|integer|min:1|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Hitung ulang kapasitas setelah perubahan
        $data['kapasitas'] =
            $data['jumlah_baris'] * $data['kursi_per_baris'];

        $studio->update($data);

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Data studio berhasil diperbarui.');
    }

    // Menghapus studio
    public function destroy(Studio $studio): RedirectResponse
    {
        // Studio yang masih memiliki jadwal tidak boleh dihapus
        if ($studio->jadwals()->exists()) {
            return redirect()
                ->route('admin.studios.index')
                ->with(
                    'error',
                    'Studio tidak dapat dihapus karena masih memiliki jadwal tayang.'
                );
        }

        $studio->delete();

        return redirect()
            ->route('admin.studios.index')
            ->with('success', 'Studio berhasil dihapus.');
    }
}