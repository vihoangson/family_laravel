<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Backup_db::class,
        Commands\ImportContent::class,
        Commands\RefreshDB::class,
        Commands\CheckMyProject::class,
        Commands\ReportGeneral::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command( 'backup_db' )
                 ->cron( "0 0 * * * *" );//1 ngày chạy 1 lần

        $schedule->command( 'import_content' )
                 ->cron( "0 0 4 * * *" );//1 ngày chạy 1 lần lúc 4h

        $schedule->command( 'check_my_project' )
                 ->cron( "0 */12 * * * *" );//1 ngày chạy 1 lần lúc 4h

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

        require base_path('routes/console.php');
    }
}
