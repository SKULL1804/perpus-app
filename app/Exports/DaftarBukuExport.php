<?php

namespace App\Exports;

use App\Models\DaftarBuku;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DaftarBukuExport implements FromQuery, WithHeadings,WithMapping
{
    use Exportable;
    private $columns = ['No', 'Kode Buku', 'Judul', 'Pengarang', 'Penerbit', 'Kategori', 'Tanggal Terbit'];

    public function map($daftarBuku): array
    {
        return [
            $daftarBuku->id,
            $daftarBuku->kode_buku,
            $daftarBuku->judul,
            $daftarBuku->pengarang,
            $daftarBuku->penerbit,
            $daftarBuku->kategoriBuku->name,
            $daftarBuku->tanggal_terbit,
        ];
    }

    public function query()
    {
        return DaftarBuku::query($this->columns);
    }

    public function headings() : array {
        return $this->columns;
    }
}
