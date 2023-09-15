<?php

namespace App\Services;

class PropertyService
{
    public function imagesManipulate($photos)
    {
        $data['first_image'] = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';

        $data['images'] = json_decode($photos, true);
        $data['img_count'] = null;
        $data['imagePath'] = null;
        $data['div_value'] = 0;

        if ($data['images']) {
            $data['first_image'] = reset($data['images']);
            $data['imagePath'] = public_path($data['first_image']);
            $data['img_count'] = count($data['images']);

            if ($data['img_count'] >= 7) {
                $data['div_value'] = 1;
            }

            if ($data['img_count'] == 5 ||  $data['img_count'] == 6) {
                $data['div_value'] = 2;
            }

            if ($data['img_count'] == 4) {
                $data['div_value'] = 3;
            }

            if ($data['img_count'] <= 3) {
                $data['div_value'] = 4;
            }
        }

        return $data;
    }
}
