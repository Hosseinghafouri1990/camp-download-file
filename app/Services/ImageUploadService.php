<?php

namespace App\Services;

use Carbon\Carbon;

class ImageUploadService
{

    public function uploadImage($file, $name = null)
    {
        $folder = public_path();
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $filePath = DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day . DIRECTORY_SEPARATOR;

        if ($name === null) {
            $fileName = time() . '.' . $file->extension();
        } else {
            $fileName = $name . '.' . $file->extension();
        }

        $file->move($folder . $filePath, $fileName);
        $file = "$filePath" . "$fileName";
        return $file;
    }

    public function removeImage($file)
    {
        $file = ltrim($file, '/');
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
