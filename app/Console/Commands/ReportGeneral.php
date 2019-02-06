<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\CommonLib;
use App\Libraries\SimsimiLib;
use App\Libraries\SmsLib;
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
        // todo: get number of post
        // todo: sent to my phone
        // todo: set 1 time a week
        dd($sms->getMoney());

    }
}
