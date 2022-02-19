<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Predictions extends Model
{
    use SoftDeletes;
    protected $table = 'predictions';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
