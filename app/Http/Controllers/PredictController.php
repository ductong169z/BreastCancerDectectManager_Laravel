<?php

namespace App\Http\Controllers;

use App\Models\ModelPredict;
use App\Models\Patients;
use App\Models\Predict;
use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;
use Spatie\Permission\Traits\HasRoles;

class PredictController extends Controller
{
    public function index(Request $request)
    {
        $predict = Predict::select('doctor.name as doctor_name', 'sonographer.name as sonographer_name', 'predict.doctor_confirmation', 'predict.id', 'patients.name as patient_name')
            ->join('users as doctor', 'doctor.id', '=', 'doctor_id')
            ->join('patients', 'patients.id', '=', 'patient_id')
            ->join('users as sonographer', 'sonographer.id', '=', 'sonographer_id')
            ->paginate();
        return view('predict.index', compact('predict'));
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
        $model_id = Setting::where('name', 'model_id')->first();
        Predict::create([
            'patient_id' => $patient_id,
            'sonographer_id' => $sonographer_id,
            'doctor_id' => Auth::id(),
            'model_id' => $model_id->value

        ]);
        return redirect(route('predict.index'));
    }

    public function edit($id)
    {
        $predict = Predict::find($id);
        $paitients = Patients::pluck('name', 'id');
        $sonographer = User::role('sonographer')->pluck('name', 'id');
        $input_image="data:image/png;base64";
        if (Storage::disk('local')->exists($predict->input_image_path)) {
            $image=Storage::disk('local')->get($predict->input_image_path);
           $extension=explode('.',$predict->input_image_path);
           $extension=end($extension);
            $input_image="data:image/".$extension.";base64,".base64_encode($image);
        }
        return view('predict.edit', compact('predict', 'sonographer', 'paitients', 'id','input_image'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $sonographer_id = $request->sonographer;
        $patient_id = $request->patient;
        $model_id = Setting::where('name', 'model_id')->first();
        $model = ModelPredict::find($model_id);
        $image = $request->image;
        $imageName = "P_" . $patient_id . '_' . $id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
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
            Predict::find($id)->update([
                'input_image_path' => $imageName,
                'predict_result' => $predict_result,
                'output_image' => $output_image,
                'accuracy' => $accuracy
            ]);
            return redirect(route('predict.index'))->with('success', 'Thành công');
        } else {
            return redirect(route('predict.index'))->with('error', 'Thất bại');

        }


    }
}
