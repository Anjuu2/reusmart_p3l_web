<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AutoPembatalanTransaksi::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        dd('Kernel.php loaded');

        $schedule->command('transaksi:auto-pembatalan')
                ->everyMinute()
                ->appendOutputTo(storage_path('logs/schedule.log'));

        $schedule->call(function () {
            app()->call('App\Http\Controllers\BarangTitipanController@cekStatusPenitipanDanDonasi');
        })->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
