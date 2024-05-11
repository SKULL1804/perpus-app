<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class KegiatanController extends Controller
{
    public function superAdmin()  {
        $kegiatan = Kegiatan::find(1);
        return view('backend.home.kegiatan.super-admin', [
            "title" => "Kegiatan"
        ],compact('kegiatan'));
    }

    public function admin()  {
        $kegiatan = Kegiatan::find(1);
        return view('backend.home.kegiatan.admin', [
            "title" => "Kegiatan"
        ],compact('kegiatan'));
    }

    public function update(Request $request, $id) {
        $kegiatan = Kegiatan::findOrFail($id);
        if ($request->file('image_kegiatan')) {

            $image = $request->file('image_kegiatan');
            $imageKegiatan = date('YmdHi').'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save((public_path('Backend/assets/img/kegiatan/'.$imageKegiatan)));

            File::delete('Backend/assets/img/kegiatan/'.$kegiatan->image_kegiatan);

            $kegiatan->update([
                'judul_kegiatan' => $request->judul_kegiatan,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
                'tempat' => $request->tempat,
                'tanggal' => $request->tanggal,
                'image_kegiatan' => $imageKegiatan,
            ]);

            return redirect()->back();

        }else {
            $kegiatan->update([
                'judul_kegiatan' => $request->judul_kegiatan,
                'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
                'tempat' => $request->tempat,
                'tanggal' => $request->tanggal,
            ]);

            return redirect()->back();
        }
    }
}
