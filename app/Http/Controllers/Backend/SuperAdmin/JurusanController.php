<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $jurusan = Jurusan::where('jurusan.name', 'like', '%'.$search.'%')
                    ->paginate(5)->onEachSide(1)->fragment('ids');
        }else{
            $jurusan = Jurusan::paginate(5)->onEachSide(1)->fragment('ids');
        }
        return view('backend.super-admin.jurusan.index', [
            "title" => "Jurusan",
            "jurusan" => $jurusan,
            "search" => $search,
        ]);
    }

    public function store(Request $request) {
        Jurusan::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        Jurusan::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        Jurusan::findOrFail($id)->delete();
        return redirect()->back();
    }
}
