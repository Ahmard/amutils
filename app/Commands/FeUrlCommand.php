<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Uticlass\Video\FeUrl;

class FeUrlCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'link:feurl {url}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Extract download link from feurl';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        console()->comment('Extracting download link...');
        $downloadUrls = (new FeUrl)->get($this->argument('url'));
        
        console()->info('Download link extracted.');
        foreach($downloadUrls as $downloadUrl){
            console()->tab()->write("Format: <comment>{$downloadUrl->type}</comment>")
                ->tab()->write("Quality: <comment>{$downloadUrl->label}</comment>")
                ->tab()->write("Download Link: <comment>{$downloadUrl->file}</comment>")
                ->newLine();
        }
        console()->info('Download link extraction finished.')->newLine();
        
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
