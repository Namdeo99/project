<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('firebase');
    }

    public function sendNotification()
    {
        $token = "eK91twpVaRo:APA91bGSYtGHvXlJzBs_tENsaA8xl4pPPH3GjogwaSa5mpNnKFk-5tHWVaKhs74C_EiYigpXlZPp21TFyNZzHJcDGxJCqVSItz8ifm1MXKp8-W8pYsEVehrLcut5KoEBN2QDsd2FYqUZ";  
        $from = "AAAAAbo63ng:APA91bGBl9M7ssXMfh1mBEzGm-8yXYVNKIBfho6e6QReAMWa7gITVdo6AeyPmMiRr2nwyefK_MAlJPp0UptQOhOSLZICqBDXDrtBIDEwL_Ow-quGROeGPl5oaJROI-ht4zH2p_60D1N4";
        $msg = array
                (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
                );

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
        dd($result);

        curl_close( $ch );
       
    }
}
