<?php


require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../configs/cloud.php';

$cloud = Cloud::getCloudinary();
$file  = $_FILES['imagem']['tmp_name'];

$uploadResult =  $cloud->uploadApi()->upload($file, [
     'folder' => 'Uploads'
]);


echo "<pre>";
    var_dump($file);
    print_r($uploadResult);
echo "</pre>";