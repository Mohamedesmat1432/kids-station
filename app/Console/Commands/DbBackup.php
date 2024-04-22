<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make backup kids station form database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! Storage::exists('backup')) {
            Storage::makeDirectory('backup');
        }

        $filenameSql = 'backup-' . Carbon::now()->format('Y-m-d') . '.sql';
        $filenameGz = 'backup-' . Carbon::now()->format('Y-m-d') . '.gz';
        $commandSql = 'mysqldump --user=' . env('DB_USERNAME') . ' --password=' . env('DB_PASSWORD') . ' --host=' . env('DB_HOST') . ' ' . env('DB_DATABASE') . '  | gzip > ' . storage_path() . '/app/backup/' . $filenameSql;
        $commandGz = 'mysqldump --user=' . env('DB_USERNAME') . ' --password=' . env('DB_PASSWORD') . ' --host=' . env('DB_HOST') . ' ' . env('DB_DATABASE') . '  | gzip > ' . storage_path() . '/app/backup/' . $filenameGz;
        $returnVar = null;
        $output = null;
        exec($commandSql,$output, $returnVar);
        exec($commandGz,$output, $returnVar);
        $this->info('The database backup is successfully');
    }
}
