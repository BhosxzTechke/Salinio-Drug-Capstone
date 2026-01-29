<?php

namespace App\Console\Commands;
use App\Services\MockCourierService;
use Illuminate\Console\Command;

class AutoUpdateMockShipments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';

    protected $signature = 'mock:update-mock-shipments';


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
        $courier = new \App\Services\MockCourierService();
        $courier->autoUpdateShipments();
        $this->info('Mock shipments updated!');

        return Command::SUCCESS;
    }
}
