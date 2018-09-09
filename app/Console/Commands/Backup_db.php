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
            $sim = new SimsimiLib;
            $sim->say_in_chatwork(config('AI.define_member.users.me'),'Đã backup database');
        }else{
            $sim = new SimsimiLib;
            $sim->say_in_chatwork(config('AI.define_member.users.me'),'Backup database thất bại');
        }

    }
}
