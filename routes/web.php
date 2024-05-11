<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\MottoController;
use App\Http\Controllers\Frontend\AlamatController;
use App\Http\Controllers\Frontend\NewBookController;
use App\Http\Controllers\Frontend\KegiatanController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Frontend\BestSellerController;
use App\Http\Controllers\Backend\SuperAdmin\DataPengunjung;
use App\Http\Controllers\Backend\Admin\KelasAdminController;
use App\Http\Controllers\Backend\SuperAdmin\KelasController;
use App\Http\Controllers\Backend\Admin\JurusanAdminController;
use App\Http\Controllers\Backend\Admin\NewBookAdminController;
use App\Http\Controllers\Backend\SuperAdmin\AnggotaController;
use App\Http\Controllers\Backend\SuperAdmin\JurusanController;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;
use App\Http\Controllers\Backend\Admin\DaftarBukuAdminController;
use App\Http\Controllers\Backend\SuperAdmin\DaftarBukuController;
use App\Http\Controllers\Backend\SuperAdmin\HistoryBukuController;
use App\Http\Controllers\Backend\Admin\KategoriBukuAdminController;
use App\Http\Controllers\Backend\SuperAdmin\KategoriBukuController;
use App\Http\Controllers\Backend\Admin\HistoryPengujungAdminController;
use App\Http\Controllers\Backend\SuperAdmin\AnggotaPengunjungController;
use App\Http\Controllers\Backend\SuperAdmin\HistoryPengunjungController;
use App\Http\Controllers\Backend\Pengunjung\PengunjungDashboardController;
use App\Http\Controllers\Backend\SuperAdmin\AnggotaPerpustakaanController;
use App\Http\Controllers\Backend\SuperAdmin\SuperAdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Utama
Route::get('/', [FrontendController::class, 'home']);

// Auth
Route::middleware('auth')->group(function () {
    Route::middleware('role:super admin')->group(function () {
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard.index');
        // Anggota Perpustakaan
        Route::get('/anggota/perpustakaan', [AnggotaPerpustakaanController::class, 'index'])->name('anggota-perpustakaan.index');
        Route::post('/anggota/perpustakaan/store', [AnggotaPerpustakaanController::class, 'store'])->name('anggota-perpustakaan.store');
        Route::post('/anggota/perpustakaan/update/{id}', [AnggotaPerpustakaanController::class, 'update'])->name('anggota-perpustakaan.update');
        Route::delete('/anggota/perpustakaan/delete/{id}', [AnggotaPerpustakaanController::class, 'destroy'])->name('anggota-perpustakaan.destroy');
        // Anggota Pengunjung
        Route::get('/anggota/pengunjung', [AnggotaPengunjungController::class, 'index'])->name('anggota-pengunjung.index');
        Route::post('/anggota/pengunjung/store', [AnggotaPengunjungController::class, 'store'])->name('anggota-pengunjung.store');
        Route::get('/anggota/pengunjung/pdf', [AnggotaPengunjungController::class, 'pdf'])->name('anggota-pengunjung.pdf');
        // Data Pengunjung
        Route::get('/data-pengunjung', [DataPengunjung::class, 'index'])->name('data-pengunjung.index');
        Route::get('/data-pengunjung/excel', [DataPengunjung::class, 'excel'])->name('data-pengunjung.excel');
        // Route::get('/data-pengunjung/pdf', [DataPengunjung::class, 'pdf'])->name('data-pengunjung.pdf');
        // History Pengunjung
        Route::get('/history-pengunjung', [HistoryPengunjungController::class, 'index'])->name('history-pengunjung.index');
        // History Buku
        Route::get('/history-buku', [HistoryBukuController::class, 'index'])->name('history-buku.index');
        // Daftar Buku
        Route::resource('/daftar-buku', DaftarBukuController::class)->only(['index']);
        Route::post('/daftar-buku/store', [DaftarBukuController::class, 'store'])->name('daftar-buku.store');
        Route::post('/daftar-buku/update/{id}', [DaftarBukuController::class, 'update'])->name('daftar-buku.update');
        Route::delete('/daftar-buku/delete/{id}', [DaftarBukuController::class, 'destroy'])->name('daftar-buku.destroy');
        Route::get('/daftar-buku/excel', [DaftarBukuController::class, 'excel'])->name('daftar-buku.excel');
        Route::get('/daftar-buku/pdf', [DaftarBukuController::class, 'pdf'])->name('daftar-buku.pdf');
        // Kategori Buku
        Route::resource('/kategori', KategoriBukuController::class)->only(['index']);
        Route::post('/kategori/store', [KategoriBukuController::class, 'store'])->name('kategori.store');
        Route::post('/kategori/update/{id}', [KategoriBukuController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/delete/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');
        // Kelas
        Route::resource('/kelas', KelasController::class)->only(['index']);
        Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::post('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
        // Jurusan
        Route::resource('/jurusan', JurusanController::class)->only(['index']);
        Route::post('/jurusan/store', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::post('/jurusan/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/jurusan/delete/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
        // About
        Route::resource('/about', AboutController::class)->only(['index']);
        Route::post('/about/update/{id}', [AboutController::class, 'update'])->name('about.update');
        // New Book
        Route::get('/new-book', [NewBookController::class, 'superAdmin'])->name('new-book.superAdmin');
        Route::post('/new-book/update/{id}', [NewBookController::class, 'update'])->name('new-book.update');
        // Best Seller
        Route::get('/best-seller', [BestSellerController::class, 'superAdmin'])->name('best-seller.superAdmin');
        Route::post('/best-seller/update/{id}', [BestSellerController::class, 'update'])->name('best-seller.update');
        // Kegiatan
        Route::get('/kegiatan', [KegiatanController::class, 'superAdmin'])->name('kegiatan.superAdmin');
        Route::post('/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        // Motto
        Route::get('/motto', [MottoController::class, 'superAdmin'])->name('motto.superAdmin');
        Route::post('/motto/update/{id}', [MottoController::class, 'update'])->name('motto.update');
        // Alamat
        Route::get('/alamat', [AlamatController::class, 'superAdmin'])->name('alamat.superAdmin');
        Route::post('/alamat/update/{id}', [AlamatController::class, 'update'])->name('alamat.update');
        // Edit Profile
        Route::get('/edit/profile', [ProfileController::class, 'superAdmin'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        // Change Password
        Route::get('/change-password', [ChangePasswordController::class, 'superAdmin'])->name('change-password.index');
        Route::post('/change-password/update', [ChangePasswordController::class, 'update'])->name('change-password.update');
    });

    // Route::middleware('role:admin')->group(function () {
    //     // Dashboard
    //     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard.index');
    //     // Daftar Buku
    //     Route::get('/admin/daftar-buku', [DaftarBukuAdminController::class, 'index'])->name('admin-daftar-buku.index');
    //     Route::post('/admin/daftar-buku/store', [DaftarBukuAdminController::class, 'store'])->name('admin-daftar-buku.store');
    //     Route::post('/admin/daftar-buku/update/{id}', [DaftarBukuAdminController::class, 'update'])->name('admin-daftar-buku.update');
    //     Route::get('/admin/daftar-buku/excel', [DaftarBukuAdminController::class, 'excel'])->name('admin-daftar-buku.excel');
    //     Route::get('/admin/daftar-buku/pdf', [DaftarBukuAdminController::class, 'pdf'])->name('admin-daftar-buku.pdf');
    //     // History Pengunjung
    //     Route::get('/admin/history-pengunjung', [HistoryPengujungAdminController::class, 'index'])->name('admin-history-pengunjung.index');
    //      // Kategori Buku
    //     Route::get('/admin/kategori-buku', [KategoriBukuAdminController::class, 'index'])->name('admin-kategori-buku.index');
    //     Route::post('/admin/kategori-buku/store', [KategoriBukuAdminController::class, 'store'])->name('admin-kategori-buku.store');
    //     Route::post('/admin/kategori-buku/update/{id}', [KategoriBukuAdminController::class, 'update'])->name('admin-kategori-buku.update');
    //     // Kelas
    //     Route::get('/admin/kelas',[ KelasAdminController::class, 'index'])->name('admin-kelas.index');
    //     Route::post('/admin/kelas/store', [KelasAdminController::class, 'store'])->name('admin-kelas.store');
    //     Route::post('/admin/kelas/update/{id}', [KelasAdminController::class, 'update'])->name('admin-kelas.update');
    //     // Jurusan
    //     Route::get('/admin/jurusan',[ JurusanAdminController::class, 'index'])->name('admin-jurusan.index');
    //     Route::post('/admin/jurusan/store', [JurusanAdminController::class, 'store'])->name('admin-jurusan.store');
    //     Route::post('/admin/jurusan/update/{id}', [JurusanAdminController::class, 'update'])->name('admin-jurusan.update');
    //     // New Book
    //     Route::get('/admin/new-book', [NewBookController::class, 'admin'])->name('admin-new-book.admin');
    //     Route::post('/admin/new-book/update/{id}', [NewBookController::class, 'update'])->name('admin-new-book.update');
    //     // Best Seller
    //     Route::get('/admin/best-seller', [BestSellerController::class, 'admin'])->name('admin-best-seller.admin');
    //     Route::post('/admin/best-seller/update/{id}', [BestSellerController::class, 'update'])->name('admin-best-seller.update');
    //     // Kegiatan
    //     Route::get('/admin/kegiatan', [KegiatanController::class, 'admin'])->name('admin-kegiatan.admin');
    //     Route::post('/admin/kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('admin-kegiatan.update');
    //     // Motto
    //     Route::get('/admin/motto', [MottoController::class, 'admin'])->name('admin-motto.admin');
    //     Route::post('/admin/motto/update/{id}', [MottoController::class, 'update'])->name('admin-motto.update');
    //     // Alamat
    //     Route::get('/admin/alamat', [AlamatController::class, 'admin'])->name('admin-alamat.admin');
    //     Route::post('/admin/alamat/update/{id}', [AlamatController::class, 'update'])->name('admin-alamat.update');
    //     // Edit Profile
    //     Route::get('admin/edit/profile', [ProfileController::class, 'admin'])->name('admin-profile.edit');
    //     Route::post('admin/profile/update', [ProfileController::class, 'update'])->name('admin-profile.update');
    //     // Change Password
    //     Route::get('admin/change-password', [ChangePasswordController::class, 'admin'])->name('admin-change-password.index');
    //     Route::post('admin/change-password/update', [ChangePasswordController::class, 'update'])->name('admin-change-password.update');
    // });

    Route::middleware('role:pengunjung')->group(function () {
        // Pengunjung
        Route::get('/home', [PengunjungDashboardController::class, 'index'])->name('home.index');
        // Membaca Buku
        Route::get('/home/baca/{id}', [PengunjungDashboardController::class, 'baca'])->name('home-baca.index');
        Route::get('/home/kategori/{id}', [PengunjungDashboardController::class, 'kategori'])->name('home-kategori.kategori');
        // Berhenti Baca
        Route::get('/home/berhenti-baca/{id}', [PengunjungDashboardController::class, 'berhentiBaca'])
        ->name('berhenti-baca');
        // Lanjutkan Baca
        Route::get('/home/lanjutkan-baca/{id}', [PengunjungDashboardController::class, 'lanjutkanBaca'])
        ->name('lanjutkan-baca');
        // Selesai Baca
        Route::get('/home/selesai-baca/{id}', [PengunjungDashboardController::class, 'selesaiBaca'])
        ->name('selesai-baca');
        // Edit Profile
        Route::get('/edit-profile', [ProfileController::class, 'pengunjung'])->name('pengunjung-profile.edit');
        Route::post('/profile-update', [ProfileController::class, 'update'])->name('pengunjung-profile.update');
        // Change Password
        Route::get('/change/password', [ChangePasswordController::class, 'pengunjung'])->name('pengunjung-change-password.index');
        Route::post('/change/password/update', [ChangePasswordController::class, 'update'])->name('pengunjung-change-password.update');
        // History
        Route::get('/home/history', [PengunjungDashboardController::class, 'history'])->name('pengunjung-history');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    // auth
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

