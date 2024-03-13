<?php

namespace App\Imports;

use App\Material;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Material([
            'partnum'      =>  $row["partnum"],
            'name'     =>  $row["name"],
            'um'     =>  $row["um"],
        ]);
    }
}
