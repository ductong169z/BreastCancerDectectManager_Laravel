<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
//    use SoftDeletes;

    protected $table = 'patients';
    protected $fillable = [
        'name',
        'id_number',
        'phone',
        'address',
        'gender',
    ];
    protected $primaryKey = 'id';
}
