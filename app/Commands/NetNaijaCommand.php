<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\Video\NetNaija;
use App\Intents;

class NetNaijaCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'link:netnaija {url}
        {--a|app=}
    ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Extract download link from https://netnaija.com';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        $app = $this->option('app') ?? 'IDM';
        console()->comment('Extracting download link...');
        $dlLink = (new NetNaija($url))->get()->linkTwo();
        
        console()->info('Download link extracted.');
        console()->question($dlLink)->newLine();
        Intents::call($app, $dlLink);
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
