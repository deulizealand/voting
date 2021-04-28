<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DapenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Member([
            'name' => $row['nama_dapen'],
            'email' => $row['email_dapen'],
        ]);
    }
}
