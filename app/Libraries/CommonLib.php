<?php
namespace App\Libraries;

use App\Mail\ToMeEmail;
use Illuminate\Support\Facades\Mail;

Class CommonLib{
    public static function alert_to_me ($msg){
        $sim = new SimsimiLib;
        $msg = config('configfamily.prefixMessage').$msg;
        $sim->say_in_chatwork(config('AI.define_member.users.me'),$msg);

        Mail::to(config('mail.my_email'))
            ->send(new ToMeEmail($msg));
    }

    public static function filterSmile($kyniem_content) {
        $kyniem_content = str_replace('<3','<img src="/asset/data/img_emotion/heart.png">',$kyniem_content);
        return $kyniem_content;
    }

    public static function convertXmlToArray($xmlstring) {
        $xml   = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
        $json  = json_encode($xml);
        $array = json_decode($json, true);
        return $array;
    }

    public static function replaceTag($kyniem_content) {
        // $kyniem_content =  preg_march('/[#(.+)]/',$kyniem_content,'222');
        //
        // $kyniem_content = str_replace('[#','<a href="">',$kyniem_content);
        // $kyniem_content = str_replace(']','</a>',$kyniem_content);
        // //dd($kyniem_content);

        // preg_replace('/<span.+class="(.+)">(.+)</span>/', '{$1}$2{/$1}', $kyniem_content);

        $kyniem_content = preg_replace('/\[#(.+)\]/', '<a href="/kyniem/tag/$1">$1</a>', $kyniem_content);
        return $kyniem_content;
    }


}