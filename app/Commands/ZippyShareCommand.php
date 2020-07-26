<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\Others\ZippyShare;
use App\Intents;

class ZippyShareCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'link:zippyshare {url}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Extract download link from zippyshare.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url');
        $dlLink = (new ZippyShare($url))->get();
        Intents::call('IDM', $dlLink);
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
