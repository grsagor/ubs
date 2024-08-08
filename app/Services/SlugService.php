<?php

namespace App\Services;

use Illuminate\Support\Str;


class SlugService
{
    public function slug_create($title, $object)
    {

        $slug = Str::slug($title);

        $slug = Str::limit($slug, 180, '');

        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $count = 1;

        while ($object->where('slug', $slug)->exists()) {
            // Append the count to the original slug to make it unique
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
