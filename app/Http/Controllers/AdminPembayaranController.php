<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPembayaranController extends Controller
{
    /**
     * Menampilkan daftar pembayaran.
     */
    public function index(Request $request): View
    {
        $keyword = $request->query('q', '');
        $keyword = is_string($keyword) ? trim($keyword) : '';

        $status = $request->query('status');

        if (
            !is_string($status) ||
            !in_array($status, ['menunggu', 'berhasil', 'gagal'], true)
        ) {
            $status = '';
        }

        $query = Pembayaran::with([
            'pemesanan.jadwal.film',
            'pemesanan.jadwal.studio',
            'pemesanan.detailKursis',
        ]);

        // Pencarian pembayaran.
        if ($keyword !== '') {
            $query->where(function ($query) use ($keyword) {
                $like = '%' . $keyword . '%';

                $query->where('kode_referensi', 'like', $like)
                    ->orWhereHas('pemesanan', function ($bookingQuery) use ($like) {

                        $bookingQuery
                            ->where('kode_booking', 'like', $like)
                            ->orWhere('nama_pemesan', 'like', $like)
                            ->orWhere('no_hp', 'like', $like)
                            ->orWhereHas('jadwal.film', function ($filmQuery) use ($like) {
                                $filmQuery->where('judul', 'like', $like);
                            });

                    });
            });
        }

        // Filter status pembayaran.
        if ($status !== '') {
            $query->where('status', $status);
        }

        $pembayarans = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Statistik keseluruhan pembayaran.
        $stats = [
            'total' => Pembayaran::count(),

            'menunggu' => Pembayaran::where(
                'status',
                'menunggu'
            )->count(),

            'berhasil' => Pembayaran::where(
                'status',
                'berhasil'
            )->count(),

            'gagal' => Pembayaran::where(
                'status',
                'gagal'
            )->count(),

            'nominal_berhasil' => Pembayaran::where(
                'status',
                'berhasil'
            )->sum('jumlah_bayar'),
        ];

        return view('admin.pembayarans.index', compact(
            'pembayarans',
            'stats',
            'keyword',
            'status'
        ));
    }


    /**
     * Menampilkan detail pembayaran.
     */
    public function show(Pembayaran $pembayaran): View
    {
        $pembayaran->load([
            'pemesanan.jadwal.film',
            'pemesanan.jadwal.studio',
            'pemesanan.detailKursis',
        ]);

        return view('admin.pembayarans.show', compact(
            'pembayaran'
        ));
    }
}