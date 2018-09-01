<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait AI_trait
{

    private $msg;
    private $room_id;
    private $config_ai;

    private function ai_init()
    {

        $this->config_ai = [
            'config.common' => [
                'config_ai'     => config('AI.config_ai'),
                'define_member' => config('AI.define_member'),
                'answers'       => config('AI.answers')
            ]
        ];
    }

    /**
     * @param $url
     *
     * @return mixed
     * @author hoang_son
     */
    private function curl($url)
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

    /**
     * @param $text
     *
     * @return string
     * @author hoang_son
     */
    private function talkToSimsimi($text)
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

        \Log::alert(json_encode([$text, $arr['response']]));

        return $arr['response'];
    }

    /**
     * @param $room_id
     * @param $msg
     *
     * @author hoang_son
     */
    public function say_in_chatwork($room_id = '', $msg = '')
    {
        if ($room_id == '') {
            $room_id = $this->room_id;
        }
        if ($msg == '') {
            $msg = $this->msg;
        }
        if ($msg == '') {
            return;
        }

        $data = ["body" => $msg];
        $ch   = curl_init("https://api.chatwork.com/v2/rooms/" . $room_id . "/messages");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-ChatWorkToken: " . env('key_chatwork')]);
        $result = curl_exec($ch);

        return $result;


    }

    public function sendResponseChatWork($room_id = '', $msg = '')
    {
        $result   = $this->say_in_chatwork($room_id, $msg);
        $response = json_decode($result);

        // Log response
        if (isset($response->errors)) {
            Log::error('Send to chatwork: ' . $result);

            return response($result, 404);

        } else {
            Log::info('Send to chatwork: ' . $result);

            return response($result);
        }
    }

    /**
     * Lấy câu hỏi dựng sẵn trong config
     *
     * @return string
     * @author hoang_son
     */
    private function stupid_answer()
    {
        $say_array     = config('AI.answers.commons');
        $stupid_answer = '[Đang trả lời ngu]: ' . $say_array[rand(0, count($say_array) - 1)] . " !!";

        return $stupid_answer . ", Hỏi gì hoài vậy ?? ";
    }
}
