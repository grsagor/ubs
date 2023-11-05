<?php

namespace App\Helpers;

class FileHelper
{
    public static function saveImages($files)
    {
        if (!is_array($files)) {
            $files = [$files];
        }
        $fileUrls = [];
        foreach ($files as $file) {
            if ($file) {
                $file_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
                $file_path = public_path('upload');
                $file->move($file_path, $file_name);
                $fileUrls[] = '/upload/' . $file_name;
            }
        }
        return json_encode($fileUrls);
    }
}
