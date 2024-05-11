<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Alamat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlamatController extends Controller
{
    public function superAdmin() {
        $alamat = Alamat::find(1);
        return view('backend.home.alamat.super-admin', [
            'title' => 'Alamat',
            'alamat' => $alamat,
        ]);
    }

    public function admin() {
        $alamat = Alamat::find(1);
        return view('backend.home.alamat.admin', [
            'title' => 'Alamat',
            'alamat' => $alamat,
        ]);
    }

    public function update(Request $request, $id) {
        $alamat = ALamat::findOrFail($id);
        $alamat->update([
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return redirect()->back();
    }
}
