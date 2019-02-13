<?php

function redirect($page):void
{
    header('location: ' . RUTE_URL . $page);
}

function saveImage($nameImage , $imageArchive):string
{ 
    $rute = RUTE_IMAGE .$nameImage;
    
    move_uploaded_file($imageArchive, $rute);

    return $nameImage;
}