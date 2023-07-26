<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait Summernote
{
    // description
    public function description(string $desc): string
    {
        // summernote editor
        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHtml($desc);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $filepath = "/upload/summernote/$filename.$mimetype";
                $images = Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        return $dom->saveHTML();
    }
}
