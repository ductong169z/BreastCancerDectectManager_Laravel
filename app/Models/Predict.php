<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Predict extends Model
{
    use SoftDeletes;
    protected $table = 'predict';
    protected $guarded = [];

    protected $primaryKey = 'id';
}
