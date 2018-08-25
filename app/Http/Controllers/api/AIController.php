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

    /**
     * @param Request $request
     *
     * @author hoang_son
     */
    public function hookchatwork(Request $request)
    {

        $msg  = '';
        $post = $request->all();

        // Kiểm tra status của bot chat
        if($post['webhook_event']['body'] == 'status_ga' ){
            if(\Cache::store('file')->get('on_chat')=='false' || !\Cache::store('file')->has('on_chat')){
                //$say =
            }
            $say = "Trạng thái của gà: " . \Cache::store('file')->get('on_chat') == 'false' ?:'đang ở ngoài';
            $this->say_in_chatwork($post['webhook_event']['room_id'], $say);
            return;
        }

        if($post['webhook_event']['body'] == 'open_chat' ){
            \Cache::store('file')->put('on_chat', 'true', 20);
        }

        if($post['webhook_event']['body'] == 'close_chat' ){
            \Cache::store('file')->put('on_chat', 'false', 20);
        }

        // Tắt chat
        if(\Cache::store('file')->get('on_chat')=='false' || !\Cache::store('file')->has('on_chat')){
            $say_array = ['Gà ngủ rồi...'];
            $say = $say_array[rand(0,count($say_array)-1)];
            $this->say_in_chatwork($post['webhook_event']['room_id'], $say);
            return;
        }


        // case thanh lâu
        if(false)
            if($post['webhook_event']['room_id'] != '120012135'){
                $say_array = [
                    'Không trả lời đâu, ahihi đồ ngốc',
                    'Đi ra ngoài shopping roài',
                    'Lát rảnh nói nghe',
                    'Khùng quá má',
                    'Rảnh hơm',
                    'Ừ',"Ok cưng",
                    '(h)',
                    'Mơ đi cưng',
                    'Không phải',
                    'Phải',
                    'Anh Chí đẹp trai nhứt',
                    'Vân và Vy đều mập',
                    'Hôm nay có ăn sáng chưa ?',
                    'Ngày mai có đi làm không chế',
                    'Đói quá',
                    'Rảnh',
                    'Mai là ngày mấy vậy',
                    'Vân có bồ chưa',
                    'Vy chừng nào hết ế',
                    'Lễ mập',
                    'Mai tao đi chơi rồi, mày đi hơm',
                    'Trà sữa đê, tao bao.',
                    'Lạnh quá cho cái mền đê',
                    'Mấy tuổi rồi',
                    'Ngu thật',
                    'Hơm phải đâu',
                    'Gà xinh đẹp',
                    'Gà biết gà đẹp',
                    'Gà chưa có trứng nên đừng có hỏi gà',
                ];

                $say = $say_array[rand(0,count($say_array)-1)];
                $this->say_in_chatwork($post['webhook_event']['room_id'], $say);
                return;
            }

        if ($post['webhook_event_type'] == 'mention_to_me') {
            $ask = $post['webhook_event']['body'];

            $pattern = '/(\[.+\]) Chicken\n/';
            $ask     = preg_replace($pattern, '', $ask);

            $pattern = '/\n/';
            $ask     = preg_replace($pattern, '', $ask);

            $msg = $this->talkToSimsimi($ask);

            $say = $msg;

            $this->say_in_chatwork($post['webhook_event']['room_id'], $say);
        }
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

        $json = $this->curl($config['simsimi']['endpoint'] . "?key=" . $config['simsimi']['token'] . "&lc=" . $config['simsimi']['locale'] . "&ft=0.7&text=" . urlencode($text));
        $arr  = json_decode($json, true);
        if (empty($arr['response'])) {
            // This trial api will have less db. Use paid key for full db. I don't try so I don't know it worth or not?
            $arr['response'] = "[Simsimi not response.]";
        }

        \Log::alert(json_encode([$text,$arr['response']]));

        return $arr['response'];
    }

    public function say_in_chatwork($room_id, $msg)
    {
        $data = ["body" => $msg];
        $ch   = curl_init("https://api.chatwork.com/v2/rooms/" . $room_id . "/messages");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-ChatWorkToken: ".env('key_chatwork')]);
        $result = curl_exec($ch);

        return;
    }

}