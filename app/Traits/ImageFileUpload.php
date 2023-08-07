<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageFileUpload
{
    //image upload
    public function image($file, $path, $width, $height)
    {
        // multiple image upload
        if (is_array($file)) {
            if (!empty($file)) {
                $gallery = [];
                $i = 1;
                foreach ($file as $item) {
                    $fileName = substr(md5(time()), 0, 20) . $i . '.' . $item->getClientOriginalExtension();
                    Image::make(file_get_contents($item))->resize($width, $height)->save($path . $fileName);
                    $gallery[] = $path . $fileName;
                    $i++;
                }
                return json_encode($gallery);
            }
        }

        // single image upload
        if (!empty($file)) {
            $fileName = substr(md5(time()), 0, 20) . '.' . $file->getClientOriginalExtension();
            Image::make(file_get_contents($file))->resize($width, $height)->save($path . $fileName);
            return $path . $fileName;
        }
        return;
    }

    public function fileUpload($file, $path)
    {
        if (!empty($file)) {
            $fileName = substr(md5(time()), 0, 20) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            return $path . $fileName;
        }
        return null;
    }
}
