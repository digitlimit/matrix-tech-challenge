<?php
/**
 * ----------------------------------------------------------------
 * This is an entry point bootstrap file
 * The webserver should always load this page first
 * 
 * php -S localhost:8080 
 * ----------------------------------------------------------------
 */

// show all PHP errors
error_reporting(-1);

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
header("Access-Control-Allow-Methods: OPTIONS,POST");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// read URL for incoming request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// these are the list of available endpoints
$endpoints = ['echo', 'invert', 'flatten', 'sum', 'multiply'];

// we are only expecting one parameter, hence throw 404 for extra parameters
// also check if the requested endpoint is available
if( !isset($uri[1]) || !in_array($uri[1], $endpoints) || isset($uri[2]) ) {
    header("HTTP/1.1 404 Not Found");
    echo json_encode([ 'message' => 'Not Found', 'success' => false ]);
    die;
}

// we import some required classes
use League\App\CSV;
use League\App\Validator;
use League\App\Matrix;

// validate file before passing to controller, lets consider this block a middleware
// for validation error status code, we will return 422 UNPROCESSABLE ENTITY
if( !isset($_FILES['file']) 
    || ($_FILES['file']['size'] == 0 && $_FILES['file']['error'] == 0) ){
    
    // set header
    header("HTTP/1.1 422 Unprocessable Entity");

    // print error
    echo json_encode([ 
        'message' => 'A valid CSV file is required', 
        'success' => false 
    ]);
    die;
}elseif( !Validator::isCSV($_FILES['file']) ){
    header("HTTP/1.1 422 Unprocessable Entity");
    echo json_encode([ 
        'message' => 'CSV file is invalid', 
        'success' => false 
    ]);
    die;
}

// check CSV is valid 
// check if matrix contains only integers
$csv = new CSV($_FILES['file']);
if( !$csv->isValidMatrix() ){
    header("HTTP/1.1 422 Unprocessable Entity");
    echo json_encode([ 
        'message' => 'CSV does not contain valid matrix', 
        'success' => false 
    ]);
    die;
}

// this will fetch matrix array
$matrix = new Matrix( $csv->getMatrix() );

// check if matrix contains only integers
if( !$matrix->containsOnlyInteger() ){
    header("HTTP/1.1 422 Unprocessable Entity");
    echo json_encode([ 
        'message' => 'Matrix in the CSV should only contain integers', 
        'success' => false 
    ]);
    die;
}

// we call a function inside the matrix class
// $uri[1] is one of 'echo', 'invert', 'flatten', 'sum', 'multiply'
// which are methods in the Matrix class
header("Content-Type: text/plain");
echo call_user_func_array([$matrix, $uri[1]], []);
die;