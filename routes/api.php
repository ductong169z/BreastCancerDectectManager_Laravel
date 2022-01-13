<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Predict;
use Yajra\DataTables\DataTables;

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
    $predict = Predict::select('doctor.name as doctor_name', 'sonographer.name as sonographer_name', 'predict.predict_result', 'predict.id', 'patients.name as patient_name')
    ->join('users as doctor', 'doctor.id', '=', 'doctor_id')
    ->join('patients', 'patients.id', '=', 'patient_id')
    ->join('users as sonographer', 'sonographer.id', '=', 'sonographer_id');
    $patient=$request->patient;
    if($patient){
        $predict=$predict->where('patients.name', 'LIKE', '%' . $patient . '%');
    }
    $predict=$predict->get();
    return Datatables::of($predict)->make(true);
 })->name('predict.api');
