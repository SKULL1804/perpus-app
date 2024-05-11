<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPengunjungExport;

class DataPengunjung extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        if(!empty($search)){
            $dataPengunjung = User::where('users.username', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '%'.$search.'%')
                    ->orWhereHas('kelas', function($k) use ($search) {
                        $k->where('name', 'like', '%'.$search.'%');
                    })
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }else{
            $dataPengunjung = User::where('role', 'pengunjung')
                    ->paginate(5)->onEachSide(2)->fragment('ids');
        }
        return view('backend.super-admin.data-pengunjung.index',[
            "title" => "Data Pengunjung",
            "dataPengunjung" => $dataPengunjung,
            "search" => $search,
        ]);
    }

    public function excel() {
        return (new DataPengunjungExport)->download('data-pengunjung.xlsx');
    }

    // public function pdf() {
    //     $dataPengunjung = User::all();
    //     $pdf = Pdf::loadView('backend.pdf.data-pengunjung-pdf', compact('dataPengunjung'));
    //     return $pdf->download('data-pengunjung.pdf');
    // }
}
