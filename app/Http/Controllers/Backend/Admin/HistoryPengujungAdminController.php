<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\HistoryBaca;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryPengujungAdminController extends Controller
{
    public function index() {
        $kategoriBuku = KategoriBuku::orderBy('name', 'ASC')->get();
        $historyBaca = HistoryBaca::with(['users', 'daftarBuku', 'ketBuku'])
            ->get();

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

        return view('backend.admin.history.index', [
            "title" => "History Pengujung",
        ], compact('kategoriBuku', 'dataPengunjung'));
    }
}
