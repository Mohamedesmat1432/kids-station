<?php

namespace App\Livewire\Backup;

use App\Traits\WithNotify;
use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ListBackup extends Component
{
    use WithNotify;

    public function download($file_name)
    {
        $this->successNotify(__('site.download_file_backup'));
        return response()->download(storage_path('app/backup/' . $file_name));
    }

    public function backupDB()
    {
        Artisan::call('db:backup');
        $this->successNotify(__('site.backup_success'));
    }

    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        $this->successNotify(__('site.cache_clear_success'));
    }

    public function render()
    {
        $this->authorize('view-backup-database');

        $files = File::allFiles(storage_path('app/backup'));

        return view('livewire.backup.list-backup',[
            'files' => $files
        ]);
    }
}
