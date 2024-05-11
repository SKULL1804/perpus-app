<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\KetBuku;
use App\Models\HistoryBaca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function store(Request $request) {
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login');
    }
}

