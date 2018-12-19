<?php

namespace App\Http\Controllers;

use App\Libraries\CommonLib;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrelloController extends Controller
{

    public function __construct() {
        parent::__construct();
        \Debugbar::disable();
    }

    public function webhook(Request $request)
    {
        if(isset($request->all()['action']['display']['translationKey'])){
            CommonLib::alert_to_me('[webhook:trello] '.$request->all()['action']['display']['translationKey']);            
        }
        
        Log::info(json_encode($request->all()));
    }


}
