<?php

namespace App\Http\Controllers\api;

use App\Libraries\BackupDBLib;
use App\Libraries\CommonLib;
use App\Libraries\GetDBSheet;
use App\Libraries\Markdown;
use App\Models\Files_model;
use App\Models\Kyniem;

use App\Models\Options;
use App\Traits\AI_trait;
use Faker\Provider\File;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Intervention\Image\ImageManager;

class AIController extends BaseController {

    use AI_trait;

    /**
     * AIController constructor.
     */
    public function __construct() {
        parent::__construct();
        \Debugbar::disable();
    }

    /**
     * @param Request $request
     *
     * @author hoang_son
     */
    public function hookchatwork(Request $request) {

        if (!$this->filter_delay_request()) {
            return;
        }

        $post = $request->all();

        if ($post == []) {
            return response('', 404);
        }
        $this->room_id = $post['webhook_event']['room_id'];

        // Hàm khởi tạo ai
        $this->ai_init();


        //<editor-fold desc="Define command for chick">
        if ($this->room_id == config('AI.define_member.users.me')) {

            switch ($post['webhook_event']['body']) {
                case "open_chat":
                break;
                case "close_chat":
                break;
                case "backup data":
                    if (BackupDBLib::backupToCloud()) {
                        $this->msg = 'Đã backup db thành công';
                    } else {
                        $this->msg = 'Chưa backup được';
                    }

                    return $this->sendResponseChatWork();
                break;
                case "deploy cho tao":
                    $request = new Request();
                    $request->initialize(['option' => 'deploy']);
                    $this->flag_deploy($request);
                    \Cache::put('deploy_frontend', '1', 1440);
                    $this->msg = 'Tuân lệnh xếp';

                    return $this->sendResponseChatWork();
                break;
                case "status":
                    $this->msg = '[code]' . json_encode($this->config_ai) . '[/code]';

                    return $this->sendResponseChatWork();
                break;
                case 'list':
                    $this->msg = "[open_chat]" . "[close_chat]" . "[backup data]" . "[deploy cho tao]" . "[status]";

                    return $this->sendResponseChatWork();
                break;
                case (preg_match('/ft:(.*)$/', $post['webhook_event']['body']) ? true : false):
                    preg_match('/ft:(.*)$/', $post['webhook_event']['body'], $match);
                    if ($match[1] > 0 && $match[1] <= 1) {
                        $this->set_cache_filter_text($match[1]);
                        CommonLib::alert_to_me(config('AI.answers.filter_text'));
                        return;
                    }
                break;
                case (preg_match('/^ga/', $post['webhook_event']['body']) ? true : false):
                    //$command = 'ga set lich 20191224 111200 Lam cai nay';
                    $command = $post['webhook_event']['body'];
                    preg_match('/^ga (.+) (\d+) (\d+) (.+)$/',$command,$match);
                    $command = $match[1];
                    $day = $match[2];
                    $time = $match[3];
                    $message = $match[4];

                    switch ($command){
                        case 'set lich':
                            CommonLib::alert_to_me('set lich');
                        break;
                        case 'get lich':
                            CommonLib::alert_to_me('get lich');
                        break;
                    }
                    //CommonLib::alert_to_me(json_encode($match));
                    return;
                break;
            }
        }
        //</editor-fold>

        //<editor-fold desc="Trả lời ngu cho các room không nằm trong danh sách">
        // Trả lời ngu cho các room không nằm trong danh sách
        if(false){
            if (!in_array($this->room_id, array_values(config('AI.config_ai.list_answer_smarty')))) {
                $this->msg = $this->stupid_answer();

                return $this->sendResponseChatWork();

                return;
            }
        }

        //</editor-fold>

        //<editor-fold desc="Xử lý khi có người nói chuyện với gà">
        // Xử lý khi có người nói chuyện với gà
        if ($post['webhook_event_type'] == 'mention_to_me') {

            // Gán câu hỏi
            $ask = $this->filter_request_ask($post['webhook_event']['body']);

            // Lấy câu trả lời từ api
            if (config('AI.config_ai.answer_smarty')) {
                $answer_command = $this->do_command($ask);
                if($answer_command == false){
                    $this->msg = $this->talkToSimsimi($ask);
                }else{
                    $this->msg = $answer_command;
                }
            } else {
                $this->msg = $this->stupid_answer();
            }


            $prefix_msg = "[To:" . $post['webhook_event']['from_account_id'] . "] \n ";
            $this->msg  = $prefix_msg . $this->msg;

            // Gửi lên chatwork theo giá trị room
            $this->room_id = $post['webhook_event']['room_id'];

            return $this->sendResponseChatWork();

            return;
        }
        //</editor-fold>

    }

    /**
     * @param Request $request
     *
     * @author hoang_son
     */
    public function chatNham(Request $request) {
        if (!$this->filter_delay_request()) {
            return;
        }

        //
        // $post          = $request->all();
        // $this->room_id = $post['webhook_event']['room_id'];
        //
        // // Hàm khởi tạo ai
        // $this->ai_init();

    }

    /**
     * Chặn không cho gửi liên tục request
     *
     * @return bool
     * @author hoang_son
     */
    private function filter_delay_request() {
        if (env('APP_ENV') == 'testing') {
            return true;
        }

        // Delay between two request
        if (\Cache::get('on_chat') == 'false') {
            return false;
        } else {
            \Cache::put('on_chat', 'false', config('AI.config_ai.delay_between_two_request'));

            return true;
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function flag_deploy(Request $request) {
        // Set bật cờ deploy
        if (!$request->input('option')) {
            return response(\Cache::get('deploy_frontend'), 200);
        }

        // Truy cập xem cờ
        if ($request->input('option') == 'deploy') {
            \Cache::put('deploy_frontend', '1', 1440);

            return response('Chuẩn bị deploy', 200);
        }
    }

    /**
     * Truy cập để tắt cờ
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @author hoang_son
     */
    public function deploy_done()
    {
        \Cache::forget('deploy_frontend');

        return response('done', 200);
    }

    /**
     * @param string $ask câu hỏi
     *
     * @return null|string|string[]
     */
    private function filter_request_ask($ask) {
        // Bỏ task to tới gà
        $pattern = '/(\[.+\]) Chicken\n/';
        $ask     = preg_replace($pattern, '', $ask);

        // Bỏ xuống dòng
        $pattern = '/\n/';
        $ask     = preg_replace($pattern, '', $ask);

        // Thay
        $pattern = '/(gà|Gà)/';
        $ask     = preg_replace($pattern, 'simsimi', $ask);

        return $ask;
    }

    /**
     * @param string $msg
     *
     * @return null|string|string[]
     */
    private function filter_response_ask(string $msg)
    {
        // Thay
        $pattern = '/(Simsimi|simsimi)/';
        $msg     = preg_replace($pattern, 'gà', $msg);

        return $msg;
    }

    private function do_command($ask){
        switch ($ask){
            case (preg_match('/task_assign:(.*)$/', $ask) ? true : false):
                preg_match('/task_assign:(.*)$/', $ask, $match);
                $data = GetDBSheet::getByAssign($match[1]);
                $return= [] ;
                foreach ($data as $key =>$value){
                    $return[]=($key+1).' '.$value['Redmin ID'].' '.$value['Sprint task'].' '.$value['Sub taks'].' '.$value['Assign'].' ['.$value['Progress'].']';
                }
                return implode('
',$return);
            break;
            case 'status':
                $data = GetDBSheet::getByAssign('Văn Hoài');
                return json_encode($data);
            break;
        }
        return false;
    }
}
