<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function index() {
        $about = About::find(1);
        return view('backend.home.about.index', [
            "title" => "About"
        ], compact('about'));
    }

    public function update(Request $request, $id) {
        $about = About::findOrFail($id);
        if ($request->file('image_about')) {

            $image = $request->file('image_about');
            $imageAbout = date('YmdHi').'.'.$image->getClientOriginalExtension();  // 3434343443.jpg
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save((public_path('Backend/assets/img/about/'.$imageAbout)));

            File::delete('Backend/assets/img/about/'.$about->image_about);

            $about->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'image_about' => $imageAbout,
            ]);

            return redirect()->back();

        }else {
            $about->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->back();
        }
    }
}
