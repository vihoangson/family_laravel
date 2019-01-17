<?php

namespace App\Libraries;

class SmsLib {

    /**
     * SmsLib constructor.
     */
    public function __construct() { }

    public function getMoney() {
        $ApiKey    = env('SMSAPIKEY');
        $SecretKey = env('SMSSECRETKEY');
        echo(file_get_contents("http://rest.esms.vn/MainService.svc/xml/GetBalance/$ApiKey/$SecretKey"));
    }

    public function sent($phonenumber, $text) {
        $ApiKey    = env('SMSAPIKEY');
        $SecretKey = env('SMSSECRETKEY');

        if (strlen(trim($text)) < 20) {
            CommonLib::alert_to_me('Gửi không được vì chuỗi nhỏ hơn 20');
            return;
        }

        $text = rawurlencode($text);
        echo "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phonenumber&Content=$text&ApiKey=$ApiKey&SecretKey=$SecretKey&IsUnicode=true&SmsType=3";
        die;
        file_get_contents("http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phonenumber&Content=$text&ApiKey=$ApiKey&SecretKey=$SecretKey&IsUnicode=true&SmsType=3");
    }

    public function sentMe($text) {
        try {
            $this->sent('0798851144', $text);
        } catch (\Exception $e) {
            CommonLib::alert_to_me('Không gửi được sms cho tôi');
        }
    }

}