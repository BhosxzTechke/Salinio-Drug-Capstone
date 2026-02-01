<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoUpdateReturnShipments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mock:update-return-shipments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courier = new \App\Services\MockReturnService;
        $courier->autoUpdateReturnShipments();
        $this->info('Mock Return updated!');

        return Command::SUCCESS;
    }
}
