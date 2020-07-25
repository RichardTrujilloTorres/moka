<?php

namespace App\Console\Commands;

use App\StorageStat;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateStorageStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moka:storage-stats:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates storage stats.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->output->title('Generating storage stats...');

        $files = Storage::disk('public')->allFiles();
        $bar = $this->output->createProgressBar(count($files));

        $bar->start();
        foreach ($files as $file) {
            $this->generateStat($file);
            $bar->advance();
        }

        $bar->finish();
    }

    protected function generateStat(string $name)
    {
        /**
         * @var StorageStat $storageStat
         */
        $storageStat = StorageStat::firstOrNew(
            ['name' => $name],
            [
                'type' => mime_content_type(storage_path('app/public') . '/' . $name),
                'size' => Storage::disk('public')->size($name),
                'last_modified' => Carbon::createFromTimestamp(Storage::disk('public')->lastModified($name)),
            ]
        );

        $storageStat->save();
    }
}
