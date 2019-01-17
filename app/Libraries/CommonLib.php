<?php
namespace App\Libraries;

Class CommonLib{
    public static function alert_to_me ($msg){
        $sim = new SimsimiLib;
        $sim->say_in_chatwork(config('AI.define_member.users.me'),config('configfamily.prefixMessage').$msg);
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


}