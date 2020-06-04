<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\Video\FEMkvCom;

class FEMkvComCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'link:femkvcom {url}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get download links from http://480mkv.com';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        $fileLoc = $this->ask('Enter file loc to save links to');
        
        FEMkvCom::from($url)
            ->episodes()
            ->save($fileLoc);
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
