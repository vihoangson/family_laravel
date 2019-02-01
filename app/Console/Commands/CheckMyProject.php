<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\ChatworkLib;
use App\Libraries\CloudinaryLib;
use App\Libraries\CommonLib;
use App\Libraries\GetDBSheet;
use App\Libraries\SimsimiLib;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Cache;
use Ixudra\Curl\Facades\Curl;

class CheckMyProject extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check_my_project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check_my_project';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $urls = [
            'http://vihoangson.com',
            'http://oop.vn',
            'http://family.vihoangson.com',
            'http://book.oop.vn',
            'http://vouu.vihoangson.com',
        ];
        $str = PHP_EOL.'check_my_project: '.PHP_EOL;
        foreach ($urls as $url) {
            $status_page = $this->checkPage($url);
            $stt         = ($status_page == 200 ? 'OK' : 'NG') . ': '.$status_page.'';
            //$str = $url .'__' .$stt;
            $str .= "$url __ [$stt]".PHP_EOL;
        }
        CommonLib::alert_to_me($str);
    }

    private function checkPage($url) {
        return Curl::to($url)
                   ->withResponseHeaders()
                   ->returnResponseObject()
                   ->get()->status;
    }
}
