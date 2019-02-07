<?php

function redirect($page)
{
    header('localhost' . RUTE_URL . $page);
}