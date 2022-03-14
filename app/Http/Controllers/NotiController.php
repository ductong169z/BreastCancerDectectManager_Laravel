<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotiController extends Controller
{
    public function index(){
        return view('noti.index');
    }

    function sennoti(array $msg){
        $token = "cs4LNFo4O54:APA91bGaaFz7MmT0wQcTDFtjqWghUhwYbsLHrHExUBnmttcC7Zsu_mtcSSHeJO4LDoYiLjL-pgFsYfdmUe6B5n0TdEtaZtJyYNC5WP0MRJpqXnyHaeWShOAbQXutJUKT_AoW08W5Q-0B";  
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

}
