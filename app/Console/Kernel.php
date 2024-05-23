<?php


namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
protected function schedule(Schedule $schedule): void
{
$schedule->call(function (){
    echo 'xxx';
});
}

protected function commands(): void
{
$this->load(__DIR__.'/Commands');

require base_path('routes/console.php');
}
}
