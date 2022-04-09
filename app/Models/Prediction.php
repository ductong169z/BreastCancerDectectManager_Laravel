<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Prediction extends Model
{
    protected  $table = 'predictions';
    use SoftDeletes;
    protected $fillable = ['patient_id', 'sonographer_id', 'doctor_id', 'status', 'model_id','predict_result','doctor_confirmation','created_at'];
    protected $primaryKey = 'id';
    public function sonographer(){

        return $this->belongsTo(User::class, 'sonographer_id');
    }
    public function doctor(){

        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function patient(){

        return $this->belongsTo(Patient::class, 'patient_id');
    }

}
