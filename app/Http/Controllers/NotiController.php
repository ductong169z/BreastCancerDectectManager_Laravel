<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotiController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        // dd($request->get('noti'));
        $search=$request->get('search');
        $notications = Notifications::where('user_id', Auth::id())->orderBy('status','desc')->orderBy('id','desc');
        if($search){
            $notications = $notications->where('notifications.title', 'LIKE', '%'.$search.'%');
        }
        $notications = $notications->paginate(10);
        return view('noti.index', compact('notications','search'));
    }

    /**
     * 
     */
    function loadNoti(){
        // dd($user_id);
        $notications = Notifications::where('user_id', Auth::id())->where('status',1)->orderBy('status','desc')->orderBy('id','desc')->take(10)->get();
        // $notications = $notications->where('user_id', Auth::id());

        // dd($notications);
        return response()->json(['notifications'=>$notications]);
    }

    /**
     * 
     */
    function notiCondition(array $notiarray){
        $noti = new Notifications();
        switch($notiarray["condition"]){
            case 'create':
                $noti->title = 'From '. $notiarray['doctor_name'];
                $noti ->body = "New prediction request created for " . $notiarray['patient_name'];
                $noti -> created_at = $notiarray['create_at'];
                break;
            case 'uploadimg':
                $noti->title = 'From ' . $notiarray['sonograper_name'];
                $noti ->body = 'Image for predict number '.$notiarray['prediction_id'].' of '.$notiarray['patient_name'].' have been upload';
                $noti -> created_at = $notiarray['create_at'];
                break;
                
        } 
        $noti ->user_id = $notiarray["user_id"];
        $noti ->prediction_id = $notiarray["prediction_id"];
        $noti ->status = 1;
        $this->sendNoti($noti);
        $this->createNoti($noti);
    }


    /**
     * 
     */
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


    /**
     * 
     */
    function updateNoti($noti_id){
        $noti=Notifications::find($noti_id);
        $noti->updated_at=Carbon::now();
        $noti->status = 0;
        // dd($noti->prediction_id);

        $noti->save();
        return redirect()->route('predict.show', $noti->prediction_id);
    }

    /**
     * 
     */
    public function send(){
        // đd()
        return view('noti.send');
    }


    /**
     * 
     */
    function sendNoti(Notifications $noti){
        
        $user=User::find($noti->user_id);  
        $token = $user->remember_token;  
        $from = "AAAAShANg-Q:APA91bFIHSNXWLUBJldYv4IMnGCYbqChEsr8Oc_Ebz9ZwXKn9ol0Cr606_tB_SfQ_QJoxLHBQbW37-GfoDIR_CcDMOS5ZoM5Lt1sjHygykS9mSwzQ8YZbFaYcE8-EXt1f_AQoRz-_bdZ";
        
        $msg = array
        (
          'body'  => $noti->body,
          'title' => $noti->title,
          'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
          'sound' => 'mySound'/*Default sound*/,
          'click_action'=>route('predict.show', $noti->prediction_id)
        );


        
        // $data = [
        //     "registration_ids" => $firebaseToken,
        //     "notification" => [
        //         "title" => $msg['title'],
        //         "body" => $msg['body'],
        //         "content_available" => true,
        //         "priority" => "high",
        //     ]
        // ];
        // $dataString = json_encode($data);

        // $headers = [
        //     'Authorization: key=' . $SERVER_API_KEY,
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        // $response = curl_exec($ch);

        // dd($response);



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
        curl_close( $ch );
        // dd($result);
    }


    public function updateToken(Request $request){
        

        $user=User::find(Auth::id());
        $user->remember_token = $request->token;
        $user->save();
        // auth()->user()->update(['device_token'=>$request->token]);
        // dd($request->token);
        return response()->json(['token saved successfully.']);
    }
    public function test(Request $request)
    {
        // dd($request->get('noti'));
        // $search=$request->get('search');
        // $notications = Notifications::where('user_id', Auth::id())->orderBy('status','desc')->orderBy('id','desc');
        // if($search){
        //     $notications = $notications->where('notifications.title', 'LIKE', '%'.$search.'%');
        // }
        // $notications = $notications->paginate(10);
        return view('noti.test');
    }


}
