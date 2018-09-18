<?php
namespace App\Libraries;

Class CommonLib{
    public static function alert_to_me ($msg){
        $sim = new SimsimiLib;
        $sim->say_in_chatwork(config('AI.define_member.users.me'),$msg);
    }
}