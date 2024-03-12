<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Material extends Model
{
    use SoftDeletes;
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $fillable = [

        'partnum',
        'name',
        'um',
        'created_at',
        'update_at',

    ];
}
