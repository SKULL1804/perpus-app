<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $kelas = Kelas::where('kelas.name', 'like', '%'.$search.'%')
                    ->paginate(5)->onEachSide(1)->fragment('ids');
        }else{
            $kelas = Kelas::paginate(5)->onEachSide(1)->fragment('ids');
        }
        return view('backend.super-admin.kelas.index', [
            "title" => "Kelas",
            "kelas" => $kelas,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        Kelas::create([
            'name' => $request->name,
            // 'jurusan' => $request->jurusan,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        Kelas::findOrFail($id)->update([
            'name' => $request->name,
            // 'jurusan' => $request->jurusan,
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        Kelas::findOrFail($id)->delete();
        return redirect()->back();
    }
}
