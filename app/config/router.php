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

$router->add(
    '/admin',
    [
        'controller' => 'admin',
        'action'     => 'index',
    ]
);

$router->add(
    '/admin/getUrls',
    [
        'controller' => 'admin',
        'action'     => 'getUrls',
    ]
);

$router->add(
    '/admin/url/{id}',
    [
        'controller' => 'admin',
        'action'     => 'url',
    ]
);

$router->notFound(
    [
        'controller' => 'error',
        'action'     => 'notFound',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);


