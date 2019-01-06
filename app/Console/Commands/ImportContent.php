<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\CommonLib;
use App\Libraries\GetDBSheet;
use App\Libraries\SimsimiLib;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class ImportContent extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import_content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import_content';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        (new \App\Libraries\ImportContent)->run();
        // Todo: check exist

        // if (BackupDBLib::backupToCloud() === true) {
        //     CommonLib::alert_to_me('Đã backup database');
        // } else {
        //     CommonLib::alert_to_me('Backup database thất bại');
        // }

    }
}
