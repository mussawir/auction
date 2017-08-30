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
        // Commands\Inspire::class,
		//'app\Console\Command\EmailCampaign'
        Commands\EmailCampaign::class,
        \App\Console\Commands\AdminEmailCampaign::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      // $schedule->command('inspire');
      //          ->hourly();
        $schedule->command('email:campaign')->daily();
        $schedule->command('adminemail:campaign')->daily();
    }
} 
 