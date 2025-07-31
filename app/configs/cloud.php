<?php

use Cloudinary\Cloudinary;

class Cloud
{
    public static function getCloudinary()
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' =>  $_ENV['cloud_name'],
                'api_key'    => $_ENV['api_key'],
                'api_secret' => $_ENV['api_secret'],
                'url'        => ['secure' => true]]]
        );

        return $cloudinary;
    }
}