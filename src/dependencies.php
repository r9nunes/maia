<?php
// DIC configuration
$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
/*
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("/../logs/app2.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
*/
//db handler
$container['DbHandler'] = function ($c) { 
    //require_once('DbHandler.php'); //todo
/*    $db = $c['settings']['db_settings'];
    $c->logger->info("${db['host']}, ${db['user']}, ${db['pass']}, ${db['database']}");
    return new \maia\DbHandler($db['host'], $db['user'], $db['pass'], $db['database']);*/
};

// Service factory for the eloquent ORM
$container['dbe'] = function ($container) {
/*    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;*/
    return "";
};

$container[TarefaMapper::class] = function ($c) { 
    //require_once('TarefaController.php'); //todo
    $db = $c['settings']['db_settings'];
    $con = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['database']);
    $erro = mysqli_connect_error();
    if ($erro){
        $c->logger->info("${db['host']}, ${db['user']}, ${db['pass']}, ${db['database']}");
        $c->logger->info("ERRO.BD:".$erro);
    }
    $mapper = new \maia\TarefaMapper($con);
    return $mapper;
};

###############=======
#controllers
$container[HelloController::class] = function ($c) { 
    //require_once('HelloController.php'); //todo
    return new \maia\HelloController($c);
};

$container[TarefaController::class] = function ($c) { 
    //require_once('TarefaController.php'); //todo
    return new \maia\TarefaController($c);
};