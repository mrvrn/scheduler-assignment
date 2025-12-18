<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogTimestampCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:log-timestamp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logs the current timestamp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Commentaar voor Jan-Volkert: De log geeft zelf al een timestamp mee, maar ik wilde het hier voor de zekerheid toch toevoegen.
        Log::info('['. now()->format('d-m-Y H:i:s') . '] LogTimestampCommand executed.');
    }
}
