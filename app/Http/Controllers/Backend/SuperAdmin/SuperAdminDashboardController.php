<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use App\Models\DaftarBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminDashboardController extends Controller
{
    public function index() {
        $dataPengunjung = User::where('role', 'pengunjung')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        // Ambil jumlah buku dari rentang waktu tertentu
        $startDateTime = now()->subDays(7); // Misalnya, ambil buku dari 7 hari terakhir
        $endDateTime = now();

        $newBookCount = DaftarBuku::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->count();

        return view('backend.super-admin.dashboard.index', [
            "title" => "Dashboard",
            "DaftarBukuCount" => DaftarBuku::count(),
            "dataPengunjung" => $dataPengunjung,
            "newBookCount" => $newBookCount,
        ]);
    }
}
