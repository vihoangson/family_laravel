<?php

namespace App\Http\Controllers\api;

use App\Libraries\Markdown;
use App\Models\Files_model;
use App\Models\Kyniem;

use App\Models\Options;
use Faker\Provider\File;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class AIController extends BaseController
{

    public function __construct() { }

    public function hookchatwork()
    {
        $ask = "Lâu chưa ?";
        $msg = $this->talkToSimsimi($ask);
        $say = '[Hỏi]:' . $ask . " [Trả lời]:" . $msg;
        $this->say_in_chatwork(120011984, $say);
    }

    function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }

    function talkToSimsimi($text)
    {
        $config = [
            'slack'   => [
                'token' => 'xoxb-xxxxxxxxxxx-xxxxxxxxxxxxxxxxxxxxxxxx'
            ],
            'simsimi' => [
                //'endpoint' => 'http://sandbox.api.simsimi.com/request.p',   // trial key
                //'token'    => 'd1dcd35a-e0ef-4757-b6ae-296a50ba9608',

                'endpoint' => 'http://api.simsimi.com/request.p',    // paid key
                'token'    => env('key_simsimi'),

                'locale' => 'vn'    // View locale support at http://developer.simsimi.com/lclist.
            ]
        ];

        $json = $this->curl($config['simsimi']['endpoint'] . "?key=" . $config['simsimi']['token'] . "&lc=" . $config['simsimi']['locale'] . "&ft=1.0&text=" . urlencode($text));
        $arr  = json_decode($json, true);
        if (empty($arr['response'])) {
            // This trial api will have less db. Use paid key for full db. I don't try so I don't know it worth or not?
            $arr['response'] = "[Simsimi not response.]";
        }

        return $arr['response'];
    }

    public function say_in_chatwork($room_id, $msg)
    {
        $data = ["body" => $msg];
        $ch   = curl_init("https://api.chatwork.com/v2/rooms/" . $room_id . "/messages");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-ChatWorkToken: 6598c5b05c7c3a1508f35fe465474caf"]);
        $result = curl_exec($ch);

        return;
    }

}