<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Utils\Importer;

class ImporterCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'import {url?} 
        {--u|url=}
        {--f|file=}
';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Download remote file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->argument('url') ?? $this->option('url');
        $file = $this->option('file');
        if(empty($file)){
            $file = $this->ask('Provide file that imported data will be saved to');
        }
        //check for shortcuts
        if(strpos($file, 'TEMP') !== false){
            $toBeReplacedWith = dirname(__FILE__, 4) . '/temp';
            $file = str_replace('TEMP', $toBeReplacedWith, $file);
        }
        
        $result = Importer::Import($url)->save($file);
        if($result){
            $this->info('File saved to '.$file);
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
