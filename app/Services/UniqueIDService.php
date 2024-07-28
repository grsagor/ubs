<?php

namespace App\Services;

class UniqueIDService
{
    // Function to generate a random 8-character alphanumeric string
    public function generateRandomAlphanumericString($length = 8)
    {
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Function to generate a unique short_id
    public function generateUniqueId($object, $column_name)
    {
        do {
            // Generate a random 8-character alphanumeric string
            $unique_id = $this->generateRandomAlphanumericString();
        } while ($object->where($column_name, $unique_id)->exists());

        return $unique_id;
    }
}
