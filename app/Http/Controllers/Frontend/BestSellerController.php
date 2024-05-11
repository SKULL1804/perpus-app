<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BestSeller;
use App\Models\HistoryBaca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BestSellerController extends Controller
{
    public function superAdmin() {
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

        return view('backend.home.best-seller.super-admin',[
            "title" => "Daftar Buku Banyak Di Baca",
        ], compact('bestBook'));
    }

    // public function admin() {
    //     $bestSeller = BestSeller::all();
    //     return view('backend.home.best-seller.admin',[
    //         "title" => "Best Seller",
    //     ], compact('bestSeller'));
    // }

    // public function update(Request $request, $id) {
    //     $bestSeller = BestSeller::findOrFail($id);
    //     // Melakukan pengecekan image_best_seller
    //     if ($request->file('image_best_seller')) {
    //         $image = $request->file('image_best_seller');
    //         $imageBestSeller = date('YmdHi').'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
    //         $resize_image = Image::make($image->getRealPath());
    //         $resize_image->resize(1024, 768, function ($constraint) {
    //             $constraint->aspectRatio();
    //         })->save((public_path('Backend/assets/img/best-seller/'.$imageBestSeller)));

    //         // Delete file image in folder public
    //         File::delete('Backend/assets/img/best-seller/'.$bestSeller->image_best_seller);

    //         // Melakukan update apabila bersama image
    //         $bestSeller->update([
    //             'image_best_seller' => $imageBestSeller,
    //             'judul' => $request->judul,
    //             'pengarang' => $request->pengarang,
    //         ]);

    //         return redirect('best-seller');

    //     } else {
    //         $bestSeller->update([
    //             'judul' => $request->judul,
    //             'pengarang' => $request->pengarang,
    //         ]);

    //         return redirect('best-seller');
    //     }

    // }
}
