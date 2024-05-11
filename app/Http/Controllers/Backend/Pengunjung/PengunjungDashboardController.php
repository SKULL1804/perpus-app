<?php

namespace App\Http\Controllers\Backend\Pengunjung;

use App\Models\KetBuku;
use App\Models\NewBook;
use App\Models\DaftarBuku;
use App\Models\HistoryBaca;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\PdfToText\Pdf;

class PengunjungDashboardController extends Controller
{
    public function index(Request $request){
        $user_id = Auth::user();
        $startDateTime = now()->subDays(7); // Misalnya, ambil buku dari 7 hari terakhir
        $endDateTime = now();
        $newBook = DaftarBuku::whereBetween('created_at', [$startDateTime, $endDateTime])
        ->orderBy('created_at', 'desc')
        ->take(5) // Urutkan berdasarkan waktu pembuatan dari yang terbaru
        ->get();
        $daftarBuku = DaftarBuku::all();
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.pengarang', 'like', '&'.$search.'%')
                    ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                        $kB->where('name', 'like', '&'.$search.'%');
                    })
                    ->paginate(4)->onEachSide(2)->fragment('ids');
        }else{
            $daftarBuku = DaftarBuku::paginate(4)->onEachSide(2)->fragment('ids');
        }

        return view('backend.pengunjung.dashboard.index', [
            "title" => "Perpustakaan",
            "daftarBuku" => $daftarBuku,
            "search" => $search,
        ], compact('newBook', 'kategoriBuku'));
    }

    // public function baca(Request $request, $id) {
    //     $daftarBuku = DaftarBuku::find($id);
    //     $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
    //     $search = $request->query('search');
    //     if(!empty($search)){
    //         $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
    //                 ->orWhere('daftar_bukus.pengarang', 'like', '%'.$search.'%')
    //                 ->orWhereHas('kategoriBuku', function($kB) use ($search) {
    //                     $kB->where('name', 'like', '%'.$search.'%');
    //                 });
    //     }
    //     return view('backend.pengunjung.dashboard.baca', [
    //         "title" => "Membaca",
    //         "daftarBuku" => $daftarBuku,
    //         "search" => $search,
    //     ], compact('kategoriBuku'));
    // }

    public function baca(Request $request, $id)
    {
        // Mendapatkan informasi buku berdasarkan $id
        $daftarBuku = DaftarBuku::findOrFail($id);
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();


        // Mengecek apakah sudah ada riwayat pembacaan buku oleh pengguna
        $historyBaca = HistoryBaca::where('id_buku', $daftarBuku->id)
        ->where('id_user', Auth::id())
        ->first();

        // Jika belum ada riwayat, simpan riwayat baru
        if (!$historyBaca) {
            $historyBaca = new HistoryBaca([
                'id_user' => Auth::id(),
                'id_buku' => $daftarBuku->id,
                'tanggal_baca' => now(),
                'id_ket' => KetBuku::where('status', 'Mulai Baca')->first()->id,
            ]);
            $historyBaca->save();
        }

        // Mengarahkan pengguna ke halaman baca
        return view('backend.pengunjung.dashboard.baca', [
            "title" => "Membaca",
            "daftarBuku" => $daftarBuku,
            "historyBaca" => $historyBaca,
            "search" => null, // Tidak ada pencarian saat membaca
        ], compact('kategoriBuku'));
    }

    // public function baca(Request $request, $id)
    // {
    //     // Mendapatkan informasi buku berdasarkan $id
    //     $daftarBuku = DaftarBuku::findOrFail($id);
    //     $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();

    //     // Mengonversi isi file PDF menjadi teks
    //     $pdfPath = public_path('document/' . $daftarBuku->file_buku); // Ganti dengan path file PDF yang sesuai
    //     $text = Pdf::getText($pdfPath);

    //     // Mengecek apakah sudah ada riwayat pembacaan buku oleh pengguna
    //     $historyBaca = HistoryBaca::where('id_buku', $daftarBuku->id)
    //     ->where('id_user', Auth::id())
    //     ->first();

    //     // Jika belum ada riwayat, simpan riwayat baru
    //     if (!$historyBaca) {
    //         $historyBaca = new HistoryBaca([
    //             'id_user' => Auth::id(),
    //             'id_buku' => $daftarBuku->id,
    //             'tanggal_baca' => now(),
    //             'id_ket' => KetBuku::where('status', 'Mulai Baca')->first()->id,
    //         ]);
    //         $historyBaca->save();
    //     }

    //     // Mengarahkan pengguna ke halaman baca
    //     return view('backend.pengunjung.dashboard.baca', [
    //         "title" => "Membaca",
    //         "daftarBuku" => $daftarBuku,
    //         "historyBaca" => $historyBaca,
    //         "search" => null, // Tidak ada pencarian saat membaca
    //         "text" => $text,
    //     ], compact('kategoriBuku'));
    // }


    public function history(Request $request) {
        $user = auth()->user();
        $jumlahBukuSelesaiBaca = $this->jumlahBukuSelesaiBaca();
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        $historyBaca = HistoryBaca::with(['users', 'daftarBuku', 'ketBuku'])
            ->where('id_user', $user->id)
            ->get();
            if(!empty($search)){
                $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                        ->orWhere('daftar_bukus.pengarang', 'like', '&'.$search.'%')
                        ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                            $kB->where('name', 'like', '&'.$search.'%');
                        })
                        ->paginate(4)->onEachSide(2)->fragment('ids');
            }else{
                $daftarBuku = DaftarBuku::paginate(4)->onEachSide(2)->fragment('ids');
            }
        return view('backend.pengunjung.dashboard.history', [
            "title" => "History",
            "search" => $search,
        ],compact('kategoriBuku', 'historyBaca', 'jumlahBukuSelesaiBaca'));
    }

    public function jumlahBukuSelesaiBaca()
    {
        $jumlahBukuSelesaiBaca = HistoryBaca::where('id_user', auth()->id())
            ->whereHas('ketBuku', function ($query) {
                $query->where('status', 'Selesai Baca');
            })
            ->count();

            return $jumlahBukuSelesaiBaca;
    }

    public function selesaiBaca($id)
    {
        $historyBaca = HistoryBaca::where('id_buku', $id)
            ->where('id_user', Auth::id())
            ->first();

        if ($historyBaca) {
            // Update status bacaan menjadi "Selesai Baca"
            $historyBaca->update(['id_ket' => KetBuku::where('status', 'Selesai Baca')->first()->id]);
        }

        return redirect()->route('home.index')->with('success', 'Selesai membaca berhasil.');
    }

    public function berhentiBaca($id)
    {
        // Temukan entri history baca yang sesuai
        $historyBaca = HistoryBaca::where('id_buku', $id)
            ->where('id_user', auth()->id())
            ->first();

        if ($historyBaca) {
                // Reset status bacaan
                $historyBaca->update(['id_ket' => KetBuku::where('status', 'Belum Selesai Baca')->first()->id]);
            }

        // Redirect atau lakukan tindakan lainnya
        return redirect()->route('home.index')->with('success', 'Berhenti membaca berhasil.');
    }

    public function lanjutkanBaca($id)
    {
        // Temukan entri history baca yang sesuai
        $historyBaca = HistoryBaca::where('id_buku', $id)
            ->where('id_user', auth()->id())
            ->first();

        if ($historyBaca) {
            // Update status bacaan menjadi "Lanjutkan Baca" (pastikan kolom status sudah ada di tabel 'ket_buku')
            $historyBaca->update(['id_ket' => KetBuku::where('status', 'Sedang Baca')->first()->id]);
        }

        // Redirect atau lakukan tindakan lainnya
        return redirect()->route('home-baca.index', ['id' => $id])->with('success', 'Lanjutkan membaca berhasil.');
    }

    public function kategori(Request $request, $id) {
        $kategoriBuku = KategoriBuku::all(); // Mengambil semua kategori
        $selectedCategory = KategoriBuku::find($id);

        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.pengarang', 'like', '%'.$search.'%')
                    ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                        $kB->where('name', 'like', '%'.$search.'%');
                    })
                    ->paginate(4)->onEachSide(2)->fragment('ids');
        } else{
            $daftarBuku = DaftarBuku::where('kategori_buku_id' , $id)
                    ->paginate(4)
                    ->onEachSide(2)
                    ->fragment('ids');
        }
        return view('backend.pengunjung.dashboard.kategori', [
            'kategoriBuku' => $kategoriBuku,
            'selectedCategory' => $selectedCategory,
            'daftarBuku' => $daftarBuku,
            'title' => 'Kategori',
            "search" => $search,
        ]);
    }

}
