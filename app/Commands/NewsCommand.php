<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\News;

class NewsCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'news {site}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Fetch news from sites';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $method = $this->argument('site');
        $newsList = News::$method()->fetch()->getAll();
        foreach ($newsList as $news){
            echo "Title: {$news['text']}\n";
            if(isset($news['summary'])) echo "Summary: {$news['summary']}\n";
            if(isset($news['time'])) echo "Time: {$news['time']}\n";
            echo "Link: {$news['href']}\n\n";
        }
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
