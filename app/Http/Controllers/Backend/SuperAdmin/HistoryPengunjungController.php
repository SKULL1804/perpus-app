<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\HistoryBaca;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class HistoryPengunjungController extends Controller
{
    public function index(Request $request) {
        $kategoriBuku = KategoriBuku::orderBy('name', 'ASC')->get();
        $historyBacaQuery = HistoryBaca::with(['users', 'daftarBuku', 'ketBuku']);

        // Pencarian berdasarkan nama
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $historyBacaQuery->whereHas('users', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $historyBaca = $historyBacaQuery->get();

        $dataPengunjung = [];

        foreach ($historyBaca as $item) {
            $id_user = $item->id_user;

            if (!isset($dataPengunjung[$id_user])) {
                $dataPengunjung[$id_user] = [
                    'users' => $item->users,
                    'tanggal_baca' => $item->tanggal_baca,
                    'jumlah_baca' => [
                        'Selesai Baca' => 0,
                        'Belum Selesai Baca' => 0,
                    ],
                ];
            }

            $statusBaca = $item->ketBuku->status;

            if ($statusBaca == 'Selesai Baca' || $statusBaca == 'Belum Selesai Baca') {
                $dataPengunjung[$id_user]['jumlah_baca'][$statusBaca]++;
            }
        }

        // Menyusun data untuk pagination
        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $slicedData = array_slice($dataPengunjung, ($currentPage - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $slicedData,
            count($dataPengunjung),
            $perPage,
            $currentPage,
            ['path' => route('history-pengunjung.index'), 'query' => request()->query()]
        );

        return view('backend.super-admin.history.pengunjung', [
            "title" => "History Pengujung",
            "kategoriBuku" => $kategoriBuku,
            "dataPengunjung" => $paginator,
        ]);
    }
}
