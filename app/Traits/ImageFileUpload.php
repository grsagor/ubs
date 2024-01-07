<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageFileUpload
{
    //image upload
    public function image($file, $path, $width, $height)
    {
        // Check if it's a single image upload
        if (!is_array($file) && !empty($file)) {
            $image_name = rand(123456, 999999) . '.' . $file->getClientOriginalExtension();
            $image_path = public_path('upload');
            $file->move($image_path, $image_name);
            return 'upload/' . $image_name;
        }

        // Check if it's a multiple image upload
        if (is_array($file) && !empty($file)) {
            $image_path = public_path('upload');
            $image_names = [];

            foreach ($file as $item) {
                $image_name = rand(123456, 999999) . '.' . $item->getClientOriginalExtension();
                $item->move($image_path, $image_name);
                $image_names[] = 'upload/' . $image_name;
            }

            return json_encode($image_names);
        }

        return;
    }

    // public function fileUpload($file, $path)
    // {
    //     if (!empty($file)) {
    //         $fileName = substr(md5(time()), 0, 20) . '.' . $file->getClientOriginalExtension();
    //         $file->move($path, $fileName);
    //         return $path . $fileName;
    //     }
    //     return null;
    // }
    public function fileUpload($file, $path)
    {
        if (!empty($file)) {
            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $fileName);
            return $path . $fileName;
        }
    }
}
