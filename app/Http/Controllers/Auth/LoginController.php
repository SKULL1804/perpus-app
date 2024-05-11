<?php

namespace App\Http\Controllers\Auth;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        $kelas = Kelas::orderBy('name','ASC')->get();
        $jurusan = Jurusan::orderBy('name','ASC')->get();
        return view('auth.login', [
            "title" => "Login",
        ],compact('kelas', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username belum diisi',
            'password.required' => 'Password belum diisi',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)){
            $user = Auth::user();
            if ($user->role == 'super admin') {
                return redirect('/dashboard');
            } elseif($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role == 'pengunjung') {
                return redirect('/home');
            }
        }else{
            return redirect('login')->withErrors('Username atau Password salah')->withInput();
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
