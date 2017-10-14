<?php

namespace App\Console;

use App\Console\Commands\Crawler;
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
        Crawler::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * Coca-cola facebook page crawler
         */
        $schedule->command('crawler:hour cocacola')
             ->everyTenMinutes();
        /**
         * Intel facebook page crawler
         */
        $schedule->command('crawler:hour intel')
            ->hourly();
        /**
         * Apple  facebook page crawler
         */
        $schedule->command('crawler:hour apple')
            ->hourly();

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
