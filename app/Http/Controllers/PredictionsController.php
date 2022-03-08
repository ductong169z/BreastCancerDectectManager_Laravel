<?php

namespace App\Http\Controllers;

use App\Models\ModelPredict;
use App\Models\Patients;
use App\Models\Predictions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;
use Spatie\Permission\Traits\HasRoles;
use GuzzleHttp\Client;

class PredictionsController extends Controller
{
    public function index(Request $request)
    {
       
        $patient = $request->patient;
        return view('predict.index', compact('patient'));
    }

    public function create(Request $request)
    {
        //        $doctor=User::role('doctor')->get();
        $paitients = Patients::pluck('name', 'id');
        $sonographer = User::role('sonographer')->pluck('name', 'id');

        return view('predict.create', compact('sonographer', 'paitients'));
    }

    public function store(Request $request)
    {
        $sonographer_id = $request->sonographer;
        $patient_id = $request->patient;
        Predictions::create([
            'patient_id' => $patient_id,
            'sonographer_id' => $sonographer_id,
            'doctor_id' => Auth::id(),
            'status'=>0,
            'model_id' => 1
        ]);
        return redirect(route('predict.index'));
    }

    public function edit($id)
    {
        $predict = Predictions::find($id);
        $paitients = Patients::pluck('name', 'id');
        $sonographer = User::role('sonographer')->pluck('name', 'id');
        $input_image = "data:image/png;base64";
        if (Storage::disk('local')->exists($predict->input_image_path)) {
            $image = Storage::disk('local')->get($predict->input_image_path);
            $extension = explode('.', $predict->input_image_path);
            $extension = end($extension);
            $input_image = "data:image/" . $extension . ";base64," . base64_encode($image);
        }
        return view('predict.edit', compact('predict', 'sonographer', 'paitients', 'id', 'input_image'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $sonographer_id = $request->sonographer;
        $patient_id = $request->patient;
        return redirect(route('predict.index'))->with('success','Update successful');
    }
    public function show($id)
    {
        $predict = Predictions::find($id);
        $paitients = Patients::pluck('name', 'id');
        $sonographer = User::role('sonographer')->pluck('name', 'id');
        $input_image = "data:image/png;base64";
        if (Storage::disk('local')->exists($predict->input_image_path)) {
            $image = Storage::disk('local')->get($predict->input_image_path);
            $extension = explode('.', $predict->input_image_path);
            $extension = end($extension);
            $input_image = "data:image/" . $extension . ";base64," . base64_encode($image);
        }
        return view('predict.detail', compact('predict', 'sonographer', 'paitients', 'id', 'input_image'));
    }
    public function delete($id)
    {
        $predict = Predictions::delete($id);
        return view('predict.detail', compact('predict', 'sonographer', 'paitients', 'id', 'input_image'));
    }
    public
    function doctorConfirm(Request $request)
    {
        $name = $request->name;
        $id = $request->id;
        Predictions::find($id)->update([
            'doctor_confirmation' => $name,
        ]);
        return redirect(route('predict.index'));
    }
    public function uploadImage(Request $request)
    {
        $id = $request->id;
        $image = $request->image;
        $imageName = "P_" . $id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $response = Curl::to('http://127.0.0.1:8000/predict/')
            ->withData(array('modelName' => 'model.h5'))
            ->withFile('image', $image, $image->getClientMimeType(), $imageName)
            ->post();
        $response = json_decode($response, true);
        
        if ($response['status'] == "success") {
            $predict_result = $response['name'];
            $accuracy = $response['score'];
            $output_image = "data:" . $image->getClientMimeType() . ";base64, " . $response['image'];
            Storage::disk('local')->put($imageName, file_get_contents($image));
            Predictions::find($id)->update([
                'input_image_path' => $imageName,
                'predict_result' => $predict_result,
                'output_image' => $output_image,
                'accuracy' => $accuracy,
                'status' => 2
            ]);
            return ['status' => 'success', 'message' => 'Upload thành công','data'=>json_encode($response)];
        } else {
            return ['status' => 'failed', 'message' => 'Upload thất bại','data'=>json_encode($response)];
        }
    }
}
