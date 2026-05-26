<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(
        \Illuminate\Foundation\Inspiring::quote()
    );
})->purpose('Display an inspiring quote');


// Schedule Commands

Schedule::command(
    'articles:archive'
)->daily();

Schedule::command(
    'articles:report'
)->dailyAt('20:00');