<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriBukuAdminController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $kategoriBuku = KategoriBuku::where('kategori_buku.name', 'like', '%'.$search.'%')
                    ->paginate(5)->onEachSide(1)->fragment('ids');
        }else{
            $kategoriBuku = KategoriBuku::paginate(5)->onEachSide(1)->fragment('ids');
        }
        return view('backend.admin.kategori-buku.index', [
            "title" => "Kategori Buku",
            "kategoriBuku" => $kategoriBuku,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        KategoriBuku::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin-kategori-buku.index');
    }

    public function update(Request $request, $id) {
        KategoriBuku::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin-kategori-buku.index');
    }
}
