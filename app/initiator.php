<?php
require_once 'config/config.php';
require_once 'helpers/url-helper.php';

//require_once 'library/DataBase.php';
//require_once 'library/Controller.php';
//require_once 'library/Core.php';

//autoload

spl_autoload_register(function($nameClass){
    require_once 'library/' . $nameClass . '.php';
});
