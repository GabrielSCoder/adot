<?php

use Cloudinary\Cloudinary;

class Cloud
{
    public static function getCloudinary()
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' =>  getenv('cloud_name'),
                'api_key'    => getenv('api_key'),
                'api_secret' => getenv('api_secret'),
                'url'        => ['secure' => true]]]
        );
        return $cloudinary;
    }
}