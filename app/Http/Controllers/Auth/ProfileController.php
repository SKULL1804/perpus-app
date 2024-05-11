<?php

namespace App\Http\Controllers\Auth;

use App\Models\NewBook;
use App\Models\DaftarBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function superAdmin(Request $request) {
        return view('backend.super-admin.profile.edit',[
            'title' => 'Edit Profile',
            'user' => $request->user(),
        ]);
    }

    public function admin(Request $request) {
        return view('backend.admin.profile.edit',[
            'title' => 'Edit Profile',
            'user' => $request->user(),
        ]);
    }

    public function pengunjung(Request $request) {
        $daftarBuku = DaftarBuku::all();
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.pengarang', 'like', '&'.$search.'%')
                    ->orWhereHas('kategoriBuku', function($kB) use ($search) {
                        $kB->where('name', 'like', '%'.$search.'%');
                    })
                    ->paginate(4)->onEachSide(2)->fragment('ids');
        }else{
            $daftarBuku = DaftarBuku::paginate(4)->onEachSide(2)->fragment('ids');
        }
        return view('backend.pengunjung.profile.edit',[
            'title' => 'Edit Profile',
            'user' => $request->user(),
            "daftarBuku" => $daftarBuku,
            "search" => $search,
        ], compact('kategoriBuku'));
    }

    public function update(Request $request) {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $user->id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'email' => 'Kolom :attribute harus berisi alamat email yang valid.',
            'unique' => 'Kolom :attribute sudah digunakan.',
            'image' => 'Kolom :attribute harus berisi file gambar.',
            'mimes' => 'Kolom :attribute harus berisi file dengan format :values.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max kilobita.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lanjutkan dengan pembaruan data pengguna jika validasi berhasil
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Backend/assets/img/avatar/'), $filename);

            // Periksa apakah pengguna memiliki avatar lama dan hapusnya
            if ($user->avatar) {
                File::delete('Backend/assets/img/avatar/' . $user->avatar);
            }

            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->back();
    }

}
