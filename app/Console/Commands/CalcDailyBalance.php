<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ScheduleController;

class CalcDailyBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:CalcDailyBalance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula los Saldos de creditos de los Colaboradores';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scheduleController = new ScheduleController();
        $scheduleController->CalcDailyBalance();

        $this->info('Calculo ejecutado correctamente.');
    }
}
