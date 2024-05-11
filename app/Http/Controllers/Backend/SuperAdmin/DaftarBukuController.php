<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\DaftarBuku;
use App\Models\HistoryBaca;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use App\Exports\DaftarBukuExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DaftarBukuController extends Controller
{
    public function index(Request $request) {
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.pengarang', 'like', '%'.$search.'%')
                    ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                        $kB->where('name', 'like', '%'.$search.'%');
                    })  
                    ->paginate(5)->onEachSide(1)->fragment('ids');
        }else{
            $daftarBuku = DaftarBuku::paginate(5)->onEachSide(1)->fragment('ids');
        }
        return view('backend.super-admin.daftar-buku.index',[
            "title" => "Daftar Buku",
            "daftarBuku" => $daftarBuku,
            "search" => $search,
            "kategoriBuku" => $kategoriBuku
        ]);
    }


    public function store(Request $request)
    {
        // // Validasi input
        // $validator = Validator::make($request->all(), [
        //     'kode_buku' => 'required|string|max:255',
        //     'judul' => 'required|string|max:255',
        //     'pengarang' => 'required|string|max:255',
        //     'penerbit' => 'required|string|max:255',
        //     'kategori_buku_id' => 'required|exists:kategori_buku,id',
        //     'file_buku' => 'required|mimes:pdf', // Sesuaikan dengan aturan validasi file
        //     'image_buku' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Sesuaikan dengan aturan validasi gambar
        //     'tanggal_terbit' => 'required|date',
        // ], [
        //     'required' => 'Kolom :attribute harus diisi.',
        //     'string' => 'Kolom :attribute harus berupa teks.',
        //     'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        //     'exists' => 'Pilihan :attribute tidak valid.',
        //     'mimes' => 'Format :attribute tidak valid.',
        //     'image' => 'Kolom :attribute harus berupa gambar.',
        //     'date' => 'Kolom :attribute harus berupa tanggal.',
        // ]);

        // // Cek validasi
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        // Lanjutkan menyimpan data jika validasi berhasil

        // upload image_buku
        $image = $request->file('image_buku');
        $imageBuku = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save((public_path('Backend/assets/img/daftar-buku/' . $imageBuku)));

        // upload isi dari buku berbentuk pdf
        $file = $request->file('file_buku');
        $fileBuku = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move('Backend/assets/document/', $fileBuku);

        $daftarBuku = new DaftarBuku();
        $daftarBuku->kode_buku = $request->kode_buku;
        $daftarBuku->image_buku = $imageBuku;
        $daftarBuku->judul = $request->judul;
        $daftarBuku->pengarang = $request->pengarang;
        $daftarBuku->penerbit = $request->penerbit;
        $daftarBuku->kategori_buku_id = $request->kategori_buku_id;
        $daftarBuku->file_buku = $fileBuku;
        $daftarBuku->tanggal_terbit = $request->tanggal_terbit;

        $daftarBuku->save();

        // return response()->json(['message' => 'Data buku berhasil disimpan.']);
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $daftarBuku = DaftarBuku::findOrFail($id);
        if ($request->file('image_buku')) {

            // Update image_buku
            $image = $request->file('image_buku');
            $imageBuku = date('YmdHi').'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save((public_path('Backend/assets/img/daftar-buku/'.$imageBuku)));

            // Delete file image in folder public
            File::delete('Backend/assets/img/daftar-buku/'.$daftarBuku->image_buku);

            // Melakukan update apabila bersama image
            $daftarBuku->update([
                'kode_buku' => $request->kode_buku,
                'image_buku' => $imageBuku,
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'kategori_buku_id' => $request->kategori_buku_id,
                'tanggal_terbit' => $request->tanggal_terbit,
            ]);

            return redirect('daftar-buku');

        } elseif ($request->file('file_buku')) {
             // update isi dari buku berbentuk pdf
            $file = $request->file('file_buku');
            $fileBuku = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move('Backend/assets/document/',$fileBuku);

            File::delete('Backend/assets/document/'.$daftarBuku->file_buku);

            $daftarBuku->update([
                'kode_buku' => $request->kode_buku,
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'file_buku' => $fileBuku,
                'kategori_buku_id' => $request->kategori_buku_id,
                'tanggal_terbit' => $request->tanggal_terbit,
            ]);

            return redirect()->back();

        }else {
           $daftarBuku->update([
                'kode_buku' => $request->kode_buku,
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'kategori_buku_id' => $request->kategori_buku_id,
                'tanggal_terbit' => $request->tanggal_terbit,
            ]);

            return redirect()->back();
        }

    }

    public function destroy($id) {
        // Menggunakan transaksi database untuk memastikan konsistensi
        DB::transaction(function () use ($id) {
            // Mendapatkan data buku
            $daftarBuku = DaftarBuku::find($id);

            // Menghapus file gambar dan dokumen terkait
            unlink('Backend/assets/img/daftar-buku/'. $daftarBuku->image_buku);
            unlink('Backend/assets/document/'. $daftarBuku->file_buku);

            // Menghapus catatan terkait di tabel history_baca
            $daftarBuku->historyBaca()->delete();

            // Menghapus buku dari daftar_bukus
            $daftarBuku->delete();
        });

        return redirect()->back();
    }

    // public function destroy($id) {
    //     // Cek apakah ada data terkait di tabel history_baca
    //     $historyBacaCount = HistoryBaca::where('id_buku', $id)->count();

    //     // Jika ada riwayat baca yang terkait
    //     if ($historyBacaCount > 0) {
    //         // Jangan menghapus riwayat baca, biarkan tetap ada
    //     }

    //     // Lanjutkan dengan menghapus buku
    //     $daftarBuku = DaftarBuku::find($id);

    //     if ($daftarBuku) {
    //         // Hapus file-file terkait (sesuaikan dengan struktur dan kebutuhan aplikasi Anda)
    //         unlink('Backend/assets/img/daftar-buku/' . $daftarBuku->image_buku);
    //         unlink('Backend/assets/document/' . $daftarBuku->file_buku);

    //         // Hapus buku
    //         $daftarBuku->delete();

    //         // Redirect kembali dengan pesan sukses
    //         return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    //     } else {
    //         // Jika buku tidak ditemukan, redirect kembali dengan pesan error
    //         return redirect()->back()->with('error', 'Buku tidak ditemukan.');
    //     }
    // }



    public function excel() {
        return (new DaftarBukuExport)->download('daftar-buku.xlsx');
    }

    public function pdf() {
        $daftarBuku = DaftarBuku::all();
        $pdf = Pdf::loadView('backend.pdf.daftar-buku-pdf', compact('daftarBuku'));
        return $pdf->download('daftar-buku.pdf');
    }
}
