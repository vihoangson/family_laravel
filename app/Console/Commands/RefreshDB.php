<?php

namespace App\Console\Commands;

use App\Libraries\BackupDBLib;
use App\Libraries\CloudinaryLib;
use App\Libraries\CommonLib;
use App\Libraries\GetDBSheet;
use App\Libraries\SimsimiLib;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Cache;

class RefreshDB extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh_db';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        if(file_exists(config('database.connections.sqlite.database'))){
            if(unlink(config('database.connections.sqlite.database'))){
                $this->warn('Deleted file db');
            }
        }
        if(!file_exists(config('database.connections.sqlite.database'))) {
            try {
                CloudinaryLib::downloadLastFileDBInCloud();
                $this->warn('Download file new');
                CloudinaryLib::do_restore();
                $this->warn('Cập nhật hình mới về local');
                Cache::flush();
                $this->warn('Xóa cache');
            } catch (\Exception $e) {
                $this->warn('Can\'t download file new');
            }
        }




    }
}
