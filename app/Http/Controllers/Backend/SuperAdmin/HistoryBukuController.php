<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\HistoryBaca;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class HistoryBukuController extends Controller
{
    // public function index() {
    //     $kategoriBuku = KategoriBuku::orderBy('name', 'ASC')->get();
    //     $historyBaca = HistoryBaca::with(['users', 'daftarBuku', 'ketBuku'])
    //         ->get();

    //     $dataBuku = [];

    //     foreach ($historyBaca as $item) {
    //         $id_buku = $item->daftarBuku->id;

    //         if (!isset($dataBuku[$id_buku])) {
    //             $dataBuku[$id_buku] = [
    //                 'judul_buku' => $item->daftarBuku->judul,
    //                 'image' => $item->daftarBuku->image_buku,
    //                 'jumlah_baca' => 0,
    //             ];
    //         }

    //         $statusBaca = $item->ketBuku->status;

    //         if ($statusBaca == 'Selesai Baca') {
    //             $dataBuku[$id_buku]['jumlah_baca']++;
    //         }
    //     }

    //     // Urutkan buku berdasarkan jumlah baca secara descending
    //     $sortedDataBuku = collect($dataBuku)->sortByDesc('jumlah_baca')->values()->all();

    //         return view('backend.super-admin.history.buku', [
    //             'title' => 'History Buku',
    //             'kategoriBuku' => $kategoriBuku,
    //             'sortedDataBuku' => $sortedDataBuku,
    //         ]);
    // }

    public function index(Request $request) {
        $kategoriBuku = KategoriBuku::orderBy('name', 'ASC')->get();
        $historyBacaQuery = HistoryBaca::with(['users', 'daftarBuku', 'ketBuku']);

        // Pencarian berdasarkan judul buku
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $historyBacaQuery->whereHas('daftarBuku', function ($query) use ($searchTerm) {
                $query->where('judul', 'like', '%' . $searchTerm . '%');
            });
        }

        $historyBaca = $historyBacaQuery->get();
        $dataBuku = [];

        foreach ($historyBaca as $item) {
            $id_buku = $item->daftarBuku->id;

            if (!isset($dataBuku[$id_buku])) {
                $dataBuku[$id_buku] = [
                    'judul_buku' => $item->daftarBuku->judul,
                    'image' => $item->daftarBuku->image_buku,
                    'jumlah_baca' => 0,
                ];
            }

            $statusBaca = $item->ketBuku->status;

            if ($statusBaca == 'Selesai Baca') {
                $dataBuku[$id_buku]['jumlah_baca']++;
            }
        }

        // Urutkan buku berdasarkan jumlah baca secara descending
        $sortedDataBuku = collect($dataBuku)->sortByDesc('jumlah_baca')->values()->all();

        // Konversi array ke LengthAwarePaginator
        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $paginator = new LengthAwarePaginator(
            array_slice($sortedDataBuku, ($currentPage - 1) * $perPage, $perPage),
            count($sortedDataBuku),
            $perPage,
            $currentPage,
            ['path' => route('history-buku.index'), 'query' => request()->query()]
        );

        return view('backend.super-admin.history.buku', [
            'title' => 'History Buku',
            'kategoriBuku' => $kategoriBuku,
            'sortedDataBuku' => $paginator,
        ]);
    }
}
