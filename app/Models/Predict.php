<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predict extends Model
{
    protected $table = 'predict';
    protected $guarded = [];

    protected $primaryKey = 'id';
}
