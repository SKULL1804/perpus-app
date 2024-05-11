<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\DaftarBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(Request $request){
        $kategoriBuku = KategoriBuku::orderBy('name','ASC')->get();
        $search = $request->query('search');
        if(!empty($search)){
            $daftarBuku = DaftarBuku::where('daftar_bukus.judul', 'like', '%'.$search.'%')
                    ->orWhere('daftar_bukus.kode_buku', 'like', '&'.$search.'%')
                    ->paginate(3)->onEachSide(1)->fragment('ids');
        }else{
            $daftarBuku = DaftarBuku::paginate(3)->onEachSide(1)->fragment('ids');
        }
        return view('backend.admin.dashboard.index', [
            "title" => "Admin",
            "DaftarBukuCount" => DaftarBuku::count(),
            "daftarBuku" => $daftarBuku,
            "kategoriBuku" => $kategoriBuku,
            "search" => $search,
        ]);
    }
}
