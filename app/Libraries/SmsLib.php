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

        $query_link = "http://rest.esms.vn/MainService.svc/xml/GetBalance/$ApiKey/$SecretKey";
        $xmlstring  = file_get_contents($query_link);

        $array = CommonLib::convertXmlToArray($xmlstring);

        return ($array);
    }

    public function sent($phonenumber, $text) {

        $ApiKey    = env('SMSAPIKEY');
        $SecretKey = env('SMSSECRETKEY');

        if (strlen(trim($text)) < 20) {
            CommonLib::alert_to_me('Gửi không được vì chuỗi nhỏ hơn 20');
            throw new \Exception('string lower than 20');
        }

        $text         = rawurlencode($text);
        $request_link = "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phonenumber&Content=$text&ApiKey=$ApiKey&SecretKey=$SecretKey&IsUnicode=true&SmsType=3";

        $xmlString = file_get_contents($request_link);
        $array = json_decode($xmlString);

        return $array;
    }

    public function sentMe($text) {
        try {
            $this->sent('0798851144', $text);
        } catch (\Exception $e) {
            CommonLib::alert_to_me('Không gửi được sms cho tôi');
        }
    }

}