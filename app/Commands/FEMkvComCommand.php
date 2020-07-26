<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\Video\FEMkvCom;
use App\Utils\Video\FEMkvCom\Saver;
use App\Utils\Video\FEMkvCom\Main;

class FEMkvComCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */

    protected $signature = 'link:femkvcom {url}';

    /**
     * The description of tnd.
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
        $fileLoc = $this->ask('Enter file loc to save links to') ?? 'storage/temp';

        (new Main($url))->get(function ($episodes) use ($fileLoc){
            $this->info('Link extraction finished.');
        })->save($fileLoc);

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
