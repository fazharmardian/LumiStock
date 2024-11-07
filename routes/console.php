<?php

use App\Console\Commands\CheckOverdueLendings;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('app:check-overdue-lendings')->everyMinute();
