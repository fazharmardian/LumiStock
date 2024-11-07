<?php

namespace App\Console\Commands;

use App\Models\Lending;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CheckOverdueLendings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue-lendings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        Log::info('CheckOverdueLendings command started.');

        $today = Carbon::today();

        Lending::where('status', '!=', 'Returned')
            ->where('status', '!=', 'Overdue')
            ->where('return_date', '<', $today)
            ->update(['status' => 'Overdue']);

        Log::info('Overdue lendings have been updated.');

        $this->info('Overdue lendings have been updated.');
    }
}
