<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paitients extends Model
{
    use SoftDeletes;

    protected $table = 'paitients';
    protected $fillable = [
    ];
    protected $primaryKey = 'id';
}
