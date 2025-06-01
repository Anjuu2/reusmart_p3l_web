<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::command('app:test-schedule-command')->everyMinute();
Schedule::call(function () {
    app()->call('App\Http\Controllers\BarangTitipanController@cekStatusPenitipanDanDonasi');
})->everyMinute();