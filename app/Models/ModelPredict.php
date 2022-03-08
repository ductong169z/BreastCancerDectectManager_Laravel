<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelPredict extends Model
{
//    use SoftDeletes;

    protected $table = 'model';
    protected $fillable = [
        'name',
        'file_name',
        'description',
        'isSelected',
        'create_at',
        'status'
    ];
    protected $primaryKey = 'id';
}
