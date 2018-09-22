<?php

namespace App\Http\Controllers;

use App\Libraries\CommonLib;
use App\Traits\Cloudinary_trait;

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
        CommonLib::alert_to_me('webhook:trello');
        echo '4d5ea62fd76aa1136000000c';
        Log::info($request->all());
    }


}
