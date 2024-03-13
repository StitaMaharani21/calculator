<?php

namespace App\Imports;

use App\Material;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelImport implements ToModel, WithHeadingRow
{

    use Importable;
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

    // public function rules(): array
    // {
    //     return [
    //         'partnum' => 'required|regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^\w\d\s]).+$/u|unique:materials',
    //         'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/u',
    //         'um' => 'required|regex:/^[a-zA-Z0-9\s]+$/u'
    //     ];
    // }
}
