<?php

$router = $di->getRouter();



// Define your routes here

$router->add(
    '/',
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);

$router->add(
    '/addUrl',
    [
        'controller' => 'index',
        'action'     => 'addUrl',
    ]
);

$router->notFound(
    [
        'controller' => 'error',
        'action'     => 'notFound',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);


