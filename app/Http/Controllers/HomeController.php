<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prediction;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //count patient, use user as var
        $patient = Patient::count();
        //current time
                Carbon::setLocale(config('app.locale'));

        $mytime = Carbon::today();//->format('Y-m-d')
        $aWeekAgo = Carbon::today()->subDays(6);
        //user
        $user = User::count();
        //total prediction
        $predict = Prediction::count();
        //correctly prediction
        $correct = Prediction::whereColumn('predictions.highest_prediction','predictions.doctor_confirmation')->count();
        //today predict
        $todayPredict = Prediction::whereDate('predictions.updated_at',date('Y-m-d'))->count();
        //today correct
        $todayCorrect = Prediction::whereColumn('predictions.highest_prediction','predictions.doctor_confirmation')->whereDate('predictions.updated_at',date('Y-m-d'))->count();
        //percentTodayCorrect
        if($todayPredict != 0){
            $percentTodayCorrect = floor($todayCorrect*100 / $todayPredict);
        }else{
            $percentTodayCorrect = 0;
        }

        //todayConfirm
        $todayConfirm = Prediction::where('predictions.doctor_confirmation', '!=', null)->whereDate('predictions.updated_at',date('Y-m-d'))->count();
        //percentTodayConfirm
        if($todayPredict != 0){
            $percentTodayConfirm = floor($todayConfirm *100/ $todayPredict);
        }else{
            $percentTodayConfirm = 0;
        }

        //chart
        $result = CarbonPeriod::create($aWeekAgo, $mytime)->toArray();
        $data = "";
        foreach ($result as $val){
            $data.="['".$val->translatedFormat('F jS')."',".self::correctPredict($val).",".self::totalPredict($val)."],";
        }
        $data = substr($data,0, strlen($data)-1);
//        dd($data);

        //percent cancers
        $normal = Prediction::where('predictions.doctor_confirmation', '=', 'normal')->count();
        $benign = Prediction::where('predictions.doctor_confirmation', '=', 'benign')->count();
        $malignant = Prediction::where('predictions.doctor_confirmation', '=', 'malignant')->count();
        $percent = "";
        $percent.="['Normal',".$normal."],['Malignant',".$malignant."],['Benign',".$benign."]";
//        dd($percent);
        $widget = [
            'patient' => $patient,
            'dayy' => $mytime,
            'user' => $user,
            'predict' => $predict,
            'correct' => $correct,
            'todayPredict' => $todayPredict,
            'todayCorrect' => $todayCorrect,
            'percentTodayCorrect' => $percentTodayCorrect,
            'todayConfirm' => $todayConfirm,
            'percentTodayConfirm' => $percentTodayConfirm,

            //..
        ];

        return view('home', compact('widget', 'data', 'percent'));
    }

    public static function totalPredict($date){
        return Prediction::whereDate('predictions.updated_at',$date)->count();;
    }

    public static function correctPredict($date){
        return Prediction::whereColumn('predictions.highest_prediction','predictions.doctor_confirmation')->whereDate('predictions.updated_at',$date)->count();;
    }
    public function about(){
        return view('about');
    }

    
}
