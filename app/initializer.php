<?php

//include config
include_once 'config/Config.php';

//include helpers
include_once 'helpers/helper.php';

//include libs
spl_autoload_register(function($nomClass){
    require_once 'libs/' . $nomClass . '.php';
});
