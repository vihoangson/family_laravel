<?php
namespace App\Libraries;

use App\Mail\ToMeEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Kyniem;

Class CommonLib{
    public static function alert_to_me ($msg){
        $sim = new SimsimiLib;
        $msg = config('configfamily.prefixMessage').$msg;
        $sim->say_in_chatwork(config('AI.define_member.users.me'),$msg);

        $is_send_mail_to_me = true;

        if($is_send_mail_to_me){
            Mail::to(config('mail.my_email'))
                ->send(new ToMeEmail($msg));
        }
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

    /**
     * Lấy số tuổi của Kem
     *
     * @return string
     */
    public static function tuoiKem(){
        $datetime1 = date_create('2016-05-09');
        $datetime2 = date_create();
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format('%Y years %M months %D days') . "\n";
    }

    public static function report() {
        $sms = new SmsLib;

        // get number of post
        $all_content = Kyniem::all()->count();
        $getmoney = $sms->getMoney();
        $Balance = $getmoney['Balance'];
        $number_img = 'Đang cập nhật';

        // Sent to my phone
        $string = 'Report general'.PHP_EOL;
        $string .= "Tổng số bài viết: $all_content".PHP_EOL;
        $string .= "Số tiền sms còn lại: $Balance".PHP_EOL;
        $string .= "Số hình ảnh: $number_img".PHP_EOL;
        return $string;
    }


}