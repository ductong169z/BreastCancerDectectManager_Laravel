<?php

namespace App\Http\Controllers;

use App\Models\ModelPredict;
use App\Models\Patient;
use App\Models\Prediction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;
use Spatie\Permission\Traits\HasRoles;
use GuzzleHttp\Client;
use App\Http\Controllers\NotiController;
use Carbon\Carbon;
use DB;
class PredictionsController extends Controller
{
    /**
     * Display all predictions
     */
    public function index(Request $request)
    {
        $patient = $request->patient;
        return view('predict.index', compact('patient'));
    }
    /**
     * Display create new prediction page
     */
    public function create(Request $request)
    {
        //get list patients
        $paitients = Patient::select("*", DB::raw("CONCAT(name,' ',id_number) as full_name"))->pluck('full_name', 'id')->prepend('---Select patient---','');
        //get list sonographer herre
        $sonographer = User::role('sonographer')->pluck('name', 'id')->prepend('---Select sonographer---','');

        return view('predict.create', compact('sonographer', 'paitients'));
    }
    /**
     * Function store prediction to database
     */
    public static function store(Request $request)
    {
        $sonographer_id = $request->sonographer;
        $patient_id = $request->patient;

        //create new prediction
        $prediction=Prediction::create([
            'patient_id' => $patient_id,
            'sonographer_id' => $sonographer_id,
            'doctor_id' => Auth::id(),
            'status'=>0,
            'model_id' => 1
        ]);

        //Notification data for create new prediction request
        $patient=Patient::find($patient_id);
        $doctor=User::find(Auth::id());
        $notiarray = array
            (
              'prediction_id'  => $prediction->id,
              'user_id' => $sonographer_id,
              'condition' => "create",
              'create_at' => Carbon::now(),
              'patient_name' => $patient->name,
              'doctor_name' => $doctor->name
            );
        $noti = new NotiController();
        $noti->notiCondition($notiarray);
       

        return redirect(route('predict.index'));
    }
    /**
     * Display edit prediction page
     */
    public function edit($id)
    {
        $predict = Prediction::find($id);
        //check prediction is exist
        if(!$predict){
            return redirect(route('predict.index'))->with('success','Prediction was not found !'); 
        }
        
        $paitients = Patient::pluck('name', 'id')->prepend('---Select patient---','');
        $sonographer = User::role('sonographer')->pluck('name', 'id')->prepend('---Select sonographer---','');
        $input_image = "data:image/png;base64";
        //load base64 image
        if (Storage::disk('local')->exists($predict->input_image_path)) {
            $image = Storage::disk('local')->get($predict->input_image_path);
            $extension = explode('.', $predict->input_image_path);
            $extension = end($extension);
            $input_image = "data:image/" . $extension . ";base64," . base64_encode($image);
        }
        return view('predict.edit', compact('predict', 'sonographer', 'paitients', 'id', 'input_image'));
    }
    /**
     * Function uppdate prediction to database
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $sonographer_id = $request->sonographer;
        $patient_id = $request->patient;
        $prediction=Prediction::find($id)->update([
            'patient_id' => $patient_id,
            'sonographer_id' => $sonographer_id,        
        ]);
        return redirect(route('predict.index'))->with('success','Update successful');
    }
    /**
     * Display detail prediction
     */
    public function show($id)
    {   
        $predict = Prediction::find($id);
        //check prediction is exist
        if(!$predict){
            return redirect(route('predict.index'))->with('success','Prediction was not found !'); 
        }
        $paitients = Patient::pluck('name', 'id');
        $currentPatient=Patient::find($predict->patient_id);
        $sonographer = User::role('sonographer')->pluck('name', 'id');
        $input_image = "data:image/png;base64";
        // process base64 image
        if (Storage::disk('local')->exists($predict->input_image_path)) {
            $image = Storage::disk('local')->get($predict->input_image_path);
            $extension = explode('.', $predict->input_image_path);
            $extension = end($extension);
            $input_image = "data:image/" . $extension . ";base64," . base64_encode($image);
        }
        return view('predict.detail', compact('predict', 'sonographer', 'paitients', 'id', 'input_image','currentPatient'));
    }
    /**
     * Delete predicton
     */
    public function delete($id)
    {
        $predict = Prediction::find($id);
        //check prediction is exist
        if(!$predict){
            return redirect(route('predict.index'))->with('success','Prediction was not found !'); 
        }
        $predict->delete();
        return redirect(route('predict.index'))->with('success','Delete successful');
    }
    /**
     * Fuinction allow doctor confirm result of prediction
     */
    public
    function doctorConfirm(Request $request)
    {
        $name = $request->name;
        $id = $request->id;
        Prediction::find($id)->update([
            'doctor_confirmation' => $name,
        ]);
        return redirect(route('predict.index'));
    }
    /**
     * Function upload image to predict
     * Return Array status,prediction result and gradcam image
     */
    public function uploadImage(Request $request)
    {
        $id = $request->id;
        $modelName=ModelPredict::getSelectedModelName();
     
        $image = $request->image;
        $imageName = "P_" . $id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $response = Curl::to('http://127.0.0.1:8000/predict/')
            ->withData(array('modelName' => $modelName))
            ->withFile('image', $image, $image->getClientMimeType(), $imageName)
            ->post();

        $response = json_decode($response, true);
        if ($response['status'] == "success") {
            $predict_result = $response['data'];
            
            $output_image = "data:" . $image->getClientMimeType() . ";base64, " . $response['image'];
            Storage::disk('local')->put($imageName, file_get_contents($image));
            Prediction::find($id)->update([
                'input_image_path' => $imageName,
                'predict_result' => json_encode($predict_result),
                'output_image' => $output_image,
                'status' => 2,
                'highest_prediction' =>array_key_first($predict_result)
            ]);
            $prediction=Prediction::find($id);
            //Notification data for create new prediction request

        $patient=Patient::find($prediction->patient_id);
        $sonograper=User::find(Auth::id());
        $notiarray = array
        (
          'prediction_id'  => $prediction->id,
          'user_id' => $prediction->doctor_id,
          'condition' => "uploadimg",
          'create_at' => Carbon::now(),
          'sonograper_name'=> $sonograper->name,
          'patient_name' => $patient->name

        );
        $noti = new NotiController();
        $noti->notiCondition($notiarray);
            return ['status' => 'success', 'message' => 'Upload thành công','data'=>json_encode($response)];
        } else {
            Prediction::find($id)->update([
                'status' => 0,
            ]);
            return ['status' => 'failed', 'message' => 'Upload thất bại','data'=>json_encode($response)];
        }
    }
    /**
     * Function update progress of prediction
     */
    public function updateProgress(Request $request)
    {
            $id = $request->id;
            Prediction::find($id)->update([
                'status' => 1,
            ]);
            return ['status' => 'success'];
    }
}
