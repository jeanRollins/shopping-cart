<?php

function redirect($page)
{
    header('location: ' . RUTE_URL . $page);
}