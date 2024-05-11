<?php

namespace App\Http\Controllers\Frontend;

use App\Models\DaftarBuku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class NewBookController extends Controller
{
    public function superAdmin() {
        // Ambil daftar buku dari rentang waktu tertentu
        $startDateTime = now()->subDays(7); // Misalnya, ambil buku dari 7 hari terakhir
        $endDateTime = now();

        $newBook = DaftarBuku::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->orderBy('created_at', 'desc')
            ->take(5) // Urutkan berdasarkan waktu pembuatan dari yang terbaru
            ->get();
        return view('backend.home.new-book.super-admin',[
            "title" => "Daftar Buku Terbaru",
        ], compact('newBook'));
    }

    // public function admin() {
    //     $newBook = NewBook::all();
    //     return view('backend.home.new-book.admin',[
    //         "title" => "New Book",
    //     ], compact('newBook'));
    // }
}
