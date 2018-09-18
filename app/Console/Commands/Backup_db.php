<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\SimsimiLib;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;


class Backup_db extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update_extra_text';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        if(BackupDBLib::backupToCloud()===true){
            CommonLib::alert_to_me('Đã backup database');
        }else{
            CommonLib::alert_to_me('Backup database thất bại');
        }

    }
}
