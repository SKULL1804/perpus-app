<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index() {
        return view('backend.super-admin.change-password.index', [
            "title" => "Change Password"
        ]);
    }

    public function update(Request $request) {
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->currentPassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newPassword);
            $users->save();
            return redirect()->back();
        }
    }
}
