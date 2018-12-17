<?php

namespace App\Libraries;

use \Illuminate\Support\Facades\Log;

class ChatworkLib {

    private $room_id;
    private $msg;

    /**
     * @return mixed
     */
    public function getRoomId() {
        return $this->room_id;
    }

    /**
     * @param mixed $room_id
     */
    public function setRoomId($room_id) {
        $this->room_id = $room_id;
    }

    /**
     * @return mixed
     */
    public function getMsg() {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg) {
        $this->msg = $msg;
    }



    /**
     * @param $room_id
     * @param $msg
     *
     * @author hoang_son
     * @return mixed|void
     */
    public function say_in_chatwork($room_id = '', $msg = '') {
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

    /**
     * @param string $room_id
     * @param string $msg
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function sendResponseChatWork($room_id = '', $msg = '') {
        $result   = $this->say_in_chatwork($room_id, $msg);
        $response = json_decode($result);

        // Log response
        if (isset($response->errors)) {
            //Log::error('Send to chatwork: ' . $result);
            return response($result, 404);
        } else {
            //Log::info('Send to chatwork: ' . $result);
            return response($result);
        }
    }

}