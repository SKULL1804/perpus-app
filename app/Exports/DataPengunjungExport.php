<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPengunjungExport implements  FromQuery, WithHeadings,WithMapping
{
    use Exportable;
    private $columns = ['No', 'Name', 'Kelas'];

    public function map($dataPengunjung): array
    {
        return [
            $dataPengunjung->id,
            $dataPengunjung->name,
            $dataPengunjung->kelas->name,
        ];
    }


    public function query()
    {
        return User::query($this->columns)->where('role', 'pengunjung');
    }

    public function headings() : array {
        return $this->columns;
    }
}
