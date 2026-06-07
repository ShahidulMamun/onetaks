<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('jobs:expire-boosts')->dailyAt('02:00');
Schedule::command('submissions:auto-approve')->dailyAt(0, '03:00');
// Schedule::command('submissions:auto-approve')->weeklyOn(0, '02:00');
