<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnggotaPerpustakaanController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $anggotaPerpustakaan = User::where('users.username', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '&'.$search.'%')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }else{
            $anggotaPerpustakaan = User::where('role', 'super admin')
                    ->orWhere('role', 'admin')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }
        return view('backend.super-admin.anggota-perpustakaan.index',[
            "title" => "Anggota Perpustakaan",
            "anggotaPerpustakaan" => $anggotaPerpustakaan,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('anggota-perpustakaan.index');
    }

    public function update(Request $request, $id) {
        User::findOrFail($id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->back();
    }


    public function destroy($id) {
        User::findOrFail($id)->delete();
        session()->flash('success','Data anggota berhasil ke hapus');
        return redirect()->back();
    }
}
