<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $anggota = User::where('users.username', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '&'.$search.'%')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }else{
            $anggota = User::where('role', 'super admin')
                    ->orWhere('role', 'admin')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }
        return view('backend.super-admin.anggota.index',[
            "title" => "Anggota",
            "anggota" => $anggota,
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
        return redirect()->route('anggota.index');
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:super admin,admin',
        ];

        $customMessages = [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'role.required' => 'Posisi harus dipilih.',
            'role.in' => 'Pilihan posisi tidak valid.',
        ];

        $this->validate($request, $rules, $customMessages);

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
