<?php

session_start();

require_once 'vendor/autoload.php';

use Acme\File\Image\ImageWithThumbnail;
use Acme\File\Upload;
use Acme\File\Video\VideoWithThumbnail;
use Acme\Helper\File;
use Acme\Storage\SessionStorage;

// $request->file tu miejsce na integracje z Laravel.
$file = File::CreateFromRequest($request->file);
$file->setFullPath('./upload/');

//Image
$imageSession = new SessionStorage('image');

//Zwykły upload
$upload = new Upload($imageSession);
$upload->save($file);

//Obraz z miniaturka
$uploadImageWithThumbnail = new ImageWithThumbnail(new Upload($imageSession));
$uploadImageWithThumbnail->save($file);

//Video
$videoSession = new SessionStorage('video');

//Zwykły upload
$upload = new Upload($videoSession);
$upload->save($file);

//Wideo z miniaturka
$uploadVideoWithThumbnail = new VideoWithThumbnail(new Upload($videoSession));
$uploadVideoWithThumbnail->save($file);
