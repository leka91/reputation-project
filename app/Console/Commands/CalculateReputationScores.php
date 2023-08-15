<?php

namespace App\Console\Commands;

use App\Interfaces\DashboardInterface;
use Illuminate\Console\Command;

class CalculateReputationScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate reputation scores';

    protected $dashboardService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DashboardInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
        
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = now();
        $this->comment('Processing');

        $locations = $this->dashboardService->getLocationsForCalculate(1);

        foreach ($locations as $location) {
            $l = $this->dashboardService->findLocationByColumn('id', $location['id'], ['id']);

            $l->update($location['scores']->toArray());
        }

        $time = $start->diffInSeconds(now());

        $this->comment("Processed in {$time} seconds");
        $this->comment('Reputation scores calculated!');
    }
}
