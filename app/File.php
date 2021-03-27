<?php

namespace App;
class File 
{
public static function save($photo , $target , $w , $h  )
    {
        $photo = str_replace('data:image/jpeg;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $photo = base64_decode($photo);
        $photoName = time().rand().  '.jpeg';
        $file = $target . $photoName ;
        $success = file_put_contents($file, $photo);
        $path_orginal = public_path($target);
        $path_thumbnail = public_path($target . 'thumbnail/');
        $file_thumb = $path_thumbnail . $photoName ;
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
      
        $dst = imagecreatetruecolor($w , $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w , $h , $width, $height);
        imagejpeg($dst, $file_thumb , 100);
        return $photoName;
    }
}