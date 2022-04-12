<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'prediction_id',
        'status'
    ];
    protected $primaryKey = 'id';
}
