<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class NotiController extends Controller
{
    public function index(){
        return view('noti.index');
    }

    function sendNoti(array $msg){
        $token = "c3IEC1jeI3Y:APA91bHWz66DOjPXpU6yq1sbVpFfmYFK5EIPNpBu1P3k9lzfdp6y3awWt4iZX3i8e9pb5gdyVKtesEcC5vDlt4_-jupLH89L2-nsdmLssnWVUfDO4EQHhdiY8mc8NFDFRtj9hEyhAeCO";  
        $from = "AAAAShANg-Q:APA91bFIHSNXWLUBJldYv4IMnGCYbqChEsr8Oc_Ebz9ZwXKn9ol0Cr606_tB_SfQ_QJoxLHBQbW37-GfoDIR_CcDMOS5ZoM5Lt1sjHygykS9mSwzQ8YZbFaYcE8-EXt1f_AQoRz-_bdZ";
        

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
        curl_close( $ch );
    }

    function loadNoti(){
        // dd($user_id);
        $notications = Notifications::where('user_id', Auth::id())->orderBy('status','desc')->get();
        // $notications = $notications->where('user_id', Auth::id());

        // dd($notications);
        return response()->json(['notifications'=>$notications]);
    }


    function notiCondition(array $notiarray){
        $noti = new Notifications();
        switch($notiarray["condition"]){
            case 'create':
                $noti->title = 'From '. $notiarray['doctor_name'];
                $noti ->body = "New predict request created for " . $notiarray['patient_name'];
                $noti -> created_at = $notiarray['create_at'];
                break;
            case 'uploadimg':
                $noti->title = 'From ' . $notiarray['prediction_id'];
                $noti ->body = 'Image for predict have been upload';
                $noti -> created_at = $notiarray['create_at'];
                break;
                
        } 
        $noti ->user_id = $notiarray["user_id"];
        $noti ->prediction_id = $notiarray["prediction_id"];
        $noti ->status = 1;

        $this->createNoti($noti);
    }

    function createNoti(Notifications $noti){
        $noti::create(
            [
            'title'=>$noti->title,
            'body'=>$noti->body,
            'user_id'=>$noti->user_id,
            'prediction_id'=>$noti->prediction_id,
            'status'=>$noti->status,
            'create_at'=>$noti->created_at
            ]
        );
    }

    function updateNoti($noti_id){
        $noti=Notifications::find($noti_id);
        $noti->updated_at=Carbon::now();
        $noti->status = 0;
        // dd($noti->prediction_id);

        $noti->save();
        return redirect()->route('predict.show', $noti->prediction_id);
    }


}
