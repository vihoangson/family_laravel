<?php
namespace App\Http\Controllers\api;

use App\Libraries\CloudinaryLib;
use App\Libraries\CommonLib;

use App\Http\Controllers\Controller as BaseController;
use App\Mail\ToMeEmail;
use Illuminate\Support\Facades\Mail;

class TestingController extends BaseController {
    /**
     * AIController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->listcheck = [
            'upload_max_filesize',
            'post_max_size',
            'upload_to_cloud',
            'send_mail',
            'send_chatwork'
        ];

        $this->checker = [];
    }

    public function run(){
        // @UML: https://www.planttext.com/?text=SoWkIImgAStDuU9I008hvupKv6o5qeAS_CIK-Dp4YlYqp9pKuiogL0LhP0K5-SKbO6bCAOXUXP9yXUIS_D8K5BdYrBmKXTp4p1nCqUICn9Bo_A9iQouk1o0Vw280
        foreach ($this->listcheck as $v){
            $this->{'check_'.$v}();
        }

        return response($this->checker);
    }

    private function check_upload_max_filesize() {
        $this->checker += ['upload_max_filesize' => [
            'real_value' =>ini_get('upload_max_filesize'),
            'expected' => '>'.config('expect.expected_upload_max_filesize','20M'),
            'result' => ((int)ini_get('upload_max_filesize') > (int)(''.config('expect.expected_upload_max_filesize','20M'))?true:false)
        ]];
    }

    private function check_post_max_size() {
        $this->checker += ['post_max_size' => [
            'real_value' =>ini_get('post_max_size'),
            'expected' => '>'.config('expect.expected_post_max_size','20M'),
            'result' => ((int)ini_get('post_max_size') > (int)(''.config('expect.expected_post_max_size','20M'))?true:false)
        ]];
    }

    private function check_upload_to_cloud() {
        $rs = CloudinaryLib::uploadImg(storage_path('image_testing/testing_img.png','testing'));
        if($rs === false){
            $this->checker += ['upload_to_cloud' => [
                'real_value' => $rs,
                'expected' => true,
                'result' => $rs
            ]];
        } else{
            $this->checker += ['upload_to_cloud' => [
                'real_value' => true,
                'expected' => true,
                'result' => true
            ]];
        }


    }

    private function check_send_mail() {
        try {
            $msg = '[TestingController] testing mail';
            Mail::to(config('mail.my_email'))
                ->send(new ToMeEmail($msg));

            $this->checker += ['check_send_mail' => [
                'real_value' => true,
                'expected' => true,
                'result' => true
            ]];
        } catch (\Exception $e) {
            $this->checker += ['check_send_mail' => [
                'real_value' => false,
                'expected' => true,
                'errors' => $e->getMessage(),
                'result' => false
            ]];
        }
    }

    private function check_send_chatwork() {
        try {
            CommonLib::alert_to_me('[TestingController] Run testing');
            $this->checker += ['send_chatwork' => [
                'real_value' => true,
                'expected' => true,
                'result' => true
            ]];
        } catch (\Exception $e) {
            $this->checker += ['send_chatwork' => [
                'real_value' => false,
                'expected' => true,
                'errors' => $e->getMessage(),
                'result' => false
            ]];
        }
    }
}