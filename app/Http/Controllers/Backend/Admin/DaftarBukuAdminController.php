<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\DaftarBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DaftarBukuExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class DaftarBukuAdminController extends Controller
{
    public function index(Request $request) {
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.kode_buku', 'like', '%'.$search.'%')
                    ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                        $kB->where('name', 'like', '%'.$search.'%');
                    })
                    ->paginate(3)->onEachSide(1)->fragment('ids');
        }else{
            $daftarBuku = DaftarBuku::paginate(3)->onEachSide(1)->fragment('ids');
        }
        return view('backend.admin.daftar-buku.index',[
            "title" => "Daftar Buku",
            "daftarBuku" => $daftarBuku,
            "kategoriBuku" => $kategoriBuku,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        // upload image_buku
        $image = $request->file('image_buku');
        $imageBuku = date('YmdHi').'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize(1024, 768, function ($constraint) {
            $constraint->aspectRatio();
        })->save((public_path('Backend/assets/img/daftar-buku/'.$imageBuku)));


        // upload isi dari buku berbentuk pdf
        $file = $request->file('file_buku');
        $fileBuku = date('YmdHi').'.'.$file->getClientOriginalExtension();
        $file->move('Backend/assets/document/' ,$fileBuku);

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
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $daftarBuku = DaftarBuku::findOrFail($id);
            //
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
            $file->move('Backend/assets/document/' ,$fileBuku);

            File::delete('Backend/assets/document/'.$daftarBuku->file_buku);

            $daftarBuku->update([
                'kode_buku' => $request->kode_buku,
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'kategori_buku_id' => $request->kategori_buku_id,
                // 'file_buku' => $fileBuku,
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

    public function excel() {
        return (new DaftarBukuExport)->download('daftar-buku.xlsx');
    }

    public function pdf() {
        $daftarBuku = DaftarBuku::all();
        $pdf = Pdf::loadView('backend.pdf.daftar-buku-pdf', compact('daftarBuku'));
        // $pdf->setPaper('A4', 'potrait');
        return $pdf->download('daftar-buku.pdf');
    }
}

