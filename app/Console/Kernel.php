<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

protected $commands = [
    \App\Console\Commands\AutoUpdateMockShipments::class, /// outbound
    \App\Console\Commands\AutoUpdateReturnShipments::class, /// inbound
];





        ///// SCHEDULING FOR DELIVERY PROCESS ADMIN TO CUSTOMER AND CUSTOMER TO ADMIN
            protected function schedule(Schedule $schedule)
            {
                $schedule->command('mock:update-mock-shipments')->everyMinute();
                $schedule->command('mock:update-return-shipments')->everyMinute();
            }




    
    // $schedule->command('backup:run', ['--only-db' => true])
    //     ->dailyAt('02:00')
    //     ->withoutOverlapping()
    //     ->runInBackground();    

    // // Example: run daily just for testing
    //     $schedule->command('inventory:update-status')->daily();

    
    /**
     * 
     * 
     * 
     * 
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


            // app/Console/Kernel.php
        protected function scheduleLOG(Schedule $schedule)
        {
            $schedule->command('activitylog:clean --days=90')->daily();
        }


}
