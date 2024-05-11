<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriBukuController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $kategoriBuku = KategoriBuku::where('kategori_buku.name', 'like', '%'.$search.'%')
                    ->paginate(5)->onEachSide(1)->fragment('ids');
        }else{
            $kategoriBuku = KategoriBuku::paginate(5)->onEachSide(1)->fragment('ids');
        }
        return view('backend.super-admin.kategori-buku.index', [
            "title" => "Kategori Buku",
            "kategoriBuku" => $kategoriBuku,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        KategoriBuku::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        KategoriBuku::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        KategoriBuku::findOrFail($id)->delete();
        return redirect()->back();
    }
}
