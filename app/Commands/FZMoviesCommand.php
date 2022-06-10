<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Uticlass\Video\FZMovies;
use App\Intents;

class FZMoviesCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'link:fzmovies {url}
        {--f|format=}
        {--a|app=}
    ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Extract download link from fzmovies';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $format = $this->option('format') ?? 1;
        $app = $this->option('app') ?? 'IDM';
        console()->comment('Extracting download link...');
        $downloadUrl = (new FZMovies($this->argument('url')))->get($format);

        console()->info('Download link extracted.');
        console()->question($downloadUrl)->newLine();
        Intents::call($app, $downloadUrl);
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
