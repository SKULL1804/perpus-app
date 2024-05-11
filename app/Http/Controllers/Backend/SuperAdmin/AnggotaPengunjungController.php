<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class AnggotaPengunjungController extends Controller
{
    public function index(Request $request) {
        $anggotaPengunjung = User::where('role', 'pengunjung');
        $kelas = Kelas::orderBy('name','ASC')->get();
        $selectedKelas = $request->input('kelas');
        $jurusan = Jurusan::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $anggotaPengunjung = User::where('users.name', 'like', '%'.$search.'%')
                    ->orWhereHas('kelas', function($k) use ($search) {
                        $k->where('name', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('jurusan', function($j) use ($search) {
                        $j->where('name', 'like', '%'.$search.'%');
                    })
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }

        if (!empty($selectedKelas)) {
            $anggotaPengunjung->whereHas('kelas', function ($query) use ($selectedKelas) {
                $query->where('name', $selectedKelas);
            });
        }

        $anggotaPengunjung = $anggotaPengunjung->paginate(5)->onEachSide(2)->fragment('ids');

        return view('backend.super-admin.anggota-pengunjung.index',[
            "title" => "Anggota Pengunjung",
            "anggotaPengunjung" => $anggotaPengunjung,
            "kelas" => $kelas,
            "selectedKelas" => $selectedKelas,
            "jurusan" => $jurusan,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'kelas_id' => $request->input('kelas_id'),
            'jurusan_id' => $request->input('jurusan_id'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('anggota-pengunjung.index');
    }

    public function pdf() {
        $anggotaPengunjung = User::where('role', 'pengunjung')->get();
        $pdf = Pdf::loadView('backend.pdf.anggota-pengunjung-pdf', compact('anggotaPengunjung'));
        return $pdf->download('anggota-pengunjung.pdf');
    }
}
