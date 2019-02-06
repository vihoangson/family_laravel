<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\CommonLib;
use App\Libraries\SimsimiLib;
use App\Libraries\SmsLib;
use App\Models\Kyniem;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;


class ReportGeneral extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report_general';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'report_general by sms';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $sms = new SmsLib;

        // get number of post
        $all_content = Kyniem::all()->count();
        $getmoney = $sms->getMoney();
        $Balance = $getmoney['Balance'];
        $number_img = 'Đang cập nhật';

        // Sent to my phone
        $string = 'Report general'.PHP_EOL;
        $string .= "Tổng số bài viết: $all_content".PHP_EOL;
        $string .= "Số tiền sms còn lại: $Balance".PHP_EOL;
        $string .= "Số hình ảnh: $number_img".PHP_EOL;

        // todo: set 1 time a week
        try {
            CommonLib::alert_to_me($string);
        } catch (\Exception $e) {
        }
        // Không gửi vào sms
        //$sms->sentMe($string);
    }
}
