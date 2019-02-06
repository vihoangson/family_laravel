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

        $string = CommonLib::report();

        // todo: set 1 time a week
        try {
            CommonLib::alert_to_me($string);
        } catch (\Exception $e) {
        }
        // Không gửi vào sms
        //$sms->sentMe($string);
    }
}
