<?php

function redirect($page)
{
    header('location: ' . RUTE_URL . $page);
}

function saveImage($nameImage , $imageArchive)
{ 
    $rute = RUTE_IMAGE .$nameImage;

    move_uploaded_file($imageArchive, $rute);
}