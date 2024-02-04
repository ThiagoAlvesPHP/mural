<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");
setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');
set_time_limit(0);

require 'config.php';

spl_autoload_register(function($class){
    if (file_exists('controllers/'.$class.'.php')) {
        require 'controllers/'.$class.'.php';
    } 
    elseif (file_exists('models/'.$class.'.php')) {
        require 'models/'.$class.'.php';
    } 
    elseif (file_exists('core/'.$class.'.php')) {
        require 'core/'.$class.'.php';
    }
});

$core = new Core();
$core->run();