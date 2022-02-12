<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = [
        'id',
        'name',
        'value',
        'create_at',
        'updated_at',
        'select'
    ];
    protected $primaryKey = 'id';}
