<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';
##################################################
#2 - ao invés de colocar aqui, pode-se colocar em um arquivo específico, i.e.: settings.php
#$config['displayErrorDetails'] = true; #Turn this on in development mode to get information about errors
#some data that I want to be able to access later.
#$config['db']['host']   = "localhost";
##################################################

session_start();
// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

##################################################
#3 #ver dependencies.php
##################################################
// Register middleware
require __DIR__ . '/../src/middleware.php';
// Register routes
require __DIR__ . '/../src/routes.php';
##################################################
# 1 # ver routes.php
##################################################

// Run app
$app->run();
