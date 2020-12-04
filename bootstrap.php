<?php 

error_reporting(E_ALL);
ini_set('display_errors', true);
 
require __DIR__ . '/vendor/autoload.php';
 
use Src\Router;
 
session_start();
 
 
try {
 
    $router = new Router;
 
    require __DIR__ . '/routes/routes.php';
 
} catch(\Exception $e){
     
    echo $e->getMessage();
}

?>