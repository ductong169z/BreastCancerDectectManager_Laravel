<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Prediction;
use Yajra\DataTables\DataTables;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('image-to-base64', function (Request $request) {
    $inputImage = $request->image;
    $base64 = base64_encode(file_get_contents($inputImage));
    return ['status' => true, 'predict' => "somthing else", 'image' => $base64];
});
 Route::get('predict/list',function(Request $request){
    $predict = Prediction::select('doctor.name as doctor_name', 'sonographer.name as sonographer_name', 'predictions.predict_result', 'predictions.id', 'patients.name as patient_name','predictions.status')
    ->join('users as doctor', 'doctor.id', '=', 'doctor_id')
    ->join('patients', 'patients.id', '=', 'patient_id')
    ->join('users as sonographer', 'sonographer.id', '=', 'sonographer_id');
    $userId=$request->userId;
    $role=User::find($userId)->roles->first()->name;

    if($role == 'doctor'){
        $predict=$predict->where('doctor_id',$userId);

    }
    if($role == 'sonographer'){
        $predict=$predict->where('sonographer_id',$userId);

    }
    $patient=$request->patient;
    if($patient){
        $predict=$predict->where('patients.name', 'LIKE', '%' . $patient . '%');
    }
    
    $predict=$predict->get();
    return Datatables::of($predict)->make(true);
 })->name('predict.api');
