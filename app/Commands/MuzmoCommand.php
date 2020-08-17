<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Uticlass\Muzmo;

class MuzmoCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'muzmo:rename {folderPath}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Rename downloaded files from http://muzmo.ru';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Muzmo::rename($this->argument('folderPath'));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
