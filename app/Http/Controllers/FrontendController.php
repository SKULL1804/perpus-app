<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Motto;
use App\Models\Alamat;
use App\Models\Kegiatan;
use App\Models\BestSeller;
use App\Models\DaftarBuku;
use App\Models\HistoryBaca;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home() {
        $about = About::find(1);
        $kegiatan = Kegiatan::find(1);
        $motto = Motto::find(1);
          // Ambil daftar buku dari rentang waktu tertentu
        $startDateTime = now()->subDays(7); // Misalnya, ambil buku dari 7 hari terakhir
        $endDateTime = now();

        $newBook = DaftarBuku::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->orderBy('created_at', 'desc')
            ->take(5) // Urutkan berdasarkan waktu pembuatan dari yang terbaru
            ->get();
        $alamat = Alamat::find(1);

        $historyBaca = HistoryBaca::with(['daftarBuku', 'ketBuku'])
        ->get();

        $dataBuku = [];

        foreach ($historyBaca as $item) {
            $id_buku = $item->daftarBuku->id;

            if (!isset($dataBuku[$id_buku])) {
                $dataBuku[$id_buku] = [
                    'judul_buku' => $item->daftarBuku->judul,
                    'image' => $item->daftarBuku->image_buku,
                    'pengarang' => $item->daftarBuku->pengarang,
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

        // Ambil lima buku paling banyak dibaca
        $bestBook = array_filter(array_slice($sortedDataBuku, 0, 5), function ($bB) {
            return $bB['jumlah_baca'] > 0;
        });
        
        return view('frontend.home.index', [
            "title" => "Nuris",
            "alamat" => $alamat,
        ], compact('about', 'kegiatan', 'newBook', 'bestBook', 'motto'));
    }
}
