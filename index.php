<?php
/**
 * ----------------------------------------------------------------
 * This is an entry point bootstrap file
 * The webserver should always load this page first
 * 
 * php -S localhost:8080 
 * ----------------------------------------------------------------
 */

/**
 * This loads composer autoload file to enable us use namespacing
 */
require './vendor/autoload.php';

/**
 * Here is a simple PHP REST API to handle requests
 */
// The code enables CORS - Cross-Origin Resource Sharing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Read URL for incoming request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// We only have an endpoint called echo, any other should return error 404
if ( $uri[1] !== 'echo' || isset($uri[2]) ) {
    header("HTTP/1.1 404 Not Found");
    die;
}

var_dump($_POST['file']); die;