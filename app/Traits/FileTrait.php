<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait FileTrait
{
    public $fileRule = 'nullable|file|mimes:jpg,png,jpeg,docx,xlsx,csv,pdf|max:12288';
    public $file;
    public $newFile;
    public $files;
    public $newFiles;

    public function uploadFile($file, $folder)
    {
        if ($file !== null && $file !== '') {
            $file_name = Carbon::now()->timestamp . '.' . $file->extension();
            $file->storeAs($folder, $file_name);
            return $file_name;
        }
    }

    public function deleteFile($file, $folder)
    {
        $path = 'files/' . $folder . '/' . $file;
        if ($file !== null && $file !== '' && file_exists(public_path($path))) {
            unlink($path);
        }
    }

    public function uploadFiles($files, $folder)
    {
        if ($files !== null) {
            $files_name = '';
            foreach ($files as $key => $file) {
                if (($file !== null && $file !== '')) {
                    $file_name = Carbon::now()->timestamp . $key . '.' . $file->extension();
                    $file->storeAs($folder, $file_name);
                    $files_name .= $file_name . ',';
                }
            }
            return rtrim($files_name, ',');
        }
    }

    public function deleteFiles($files, $folder)
    {
        if ($files !== null) {

            $file_names = explode(',', $files);

            foreach ($file_names as $file) {
                $path = 'files/' . $folder . '/' . $file;
                if ($file !== null && $file !== '' && file_exists(public_path($path))) {
                    unlink($path);
                }
            }
        }
    }
}
