<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\DaftarBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function superAdmin() {
        return view('backend.super-admin.change-password.index', [
            "title" => "Change Password"
        ]);
    }

    public function admin() {
        return view('backend.admin.change-password.index', [
            "title" => "Change Password"
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
        return view('backend.pengunjung.change-password.index', [
            "title" => "Change Password",
            "daftarBuku" => $daftarBuku,
            "search" => $search,
            "kategoriBuku" => $kategoriBuku
        ]);
    }

    public function update(Request $request) {
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->currentPassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $validator = Validator::make($request->all(), [
                'currentPassword' => 'required',
                'newPassword' => 'required|min:8|different:currentPassword',
                'confirmPassword' => 'required|same:newPassword',
            ], [
                'currentPassword.required' => 'Kata sandi saat ini harus diisi.',
                'newPassword.required' => 'Kata sandi baru harus diisi.',
                'newPassword.min' => 'Kata sandi baru setidaknya harus memiliki 8 karakter.',
                'newPassword.different' => 'Kata sandi baru harus berbeda dengan kata sandi saat ini.',
                'confirmPassword.required' => 'Konfirmasi kata sandi baru harus diisi.',
                'confirmPassword.same' => 'Konfirmasi kata sandi baru harus sama dengan kata sandi baru.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $users->password = bcrypt($request->newPassword);
            $users->save();
            return redirect()->back();
        }
    }

    // public function update(Request $request) {
    //     $hashedPassword = Auth::user()->password;
    //     if (Hash::check($request->currentPassword, $hashedPassword)) {
    //         $users = User::find(Auth::id());

    //         $validator = Validator::make($request->all(), [
    //             'currentPassword' => 'required',
    //             'newPassword' => 'required|min:8|different:currentPassword',
    //             'confirmPassword' => 'required|same:newPassword',
    //         ], [
    //             'currentPassword.required' => 'Kata sandi saat ini harus diisi.',
    //             'newPassword.required' => 'Kata sandi baru harus diisi.',
    //             'newPassword.min' => 'Kata sandi baru setidaknya harus memiliki 8 karakter.',
    //             'newPassword.different' => 'Kata sandi baru harus berbeda dengan kata sandi saat ini.',
    //             'confirmPassword.required' => 'Konfirmasi kata sandi baru harus diisi.',
    //             'confirmPassword.same' => 'Konfirmasi kata sandi baru harus sama dengan kata sandi baru.',
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $users->password = bcrypt($request->newPassword);
    //         $users->save();

    //         return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
    //     }

    //     return redirect()->back()->with('error', 'Kata sandi saat ini tidak valid.');
    // }


}
