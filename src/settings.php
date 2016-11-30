<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app1.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // DB
        #some data that I want to be able to access later.
        'db_settings' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'database' => 'agenda-g',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];
