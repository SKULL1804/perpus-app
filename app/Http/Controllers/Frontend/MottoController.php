<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Motto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MottoController extends Controller
{
    public function superAdmin() {
        $motto = Motto::find(1);
        return view('backend.home.motto.super-admin', [
            "title" => "Motto"
        ], compact('motto'));
    }

    public function admin() {
        $motto = Motto::find(1);
        return view('backend.home.motto.admin', [
            "title" => "Motto"
        ],compact('motto'));
    }

    public function update(Request $request, $id) {
        $motto = Motto::findOrFail($id);
        $motto->update([
            'ajakan' => $request->ajakan,
            'motto' => $request->motto,
        ]);

        return redirect()->back();
    }
}
