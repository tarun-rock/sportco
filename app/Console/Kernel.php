<?php

namespace App\Console;

use App\Http\Controllers\CoreController as Core;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\WidgetController;
//use Morrislaptop\Firestore\Firestore;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
       // Commands\FootballLiveScores::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('FootballLiveScores')
          //        ->cron('0 0 */3 * *');
        /*$schedule->call(function (Firestore $firestore) {
            Core::getTokenEntitysport();
        })->cron('0 0 *//*3 * *');*/

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
