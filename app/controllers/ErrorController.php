<?php
declare(strict_types=1);

use Phalcon\Http\Response;

class ErrorController extends \Phalcon\Mvc\Controller
{

    public function notFoundAction()
    {
        $response = new Response();
        $response -> setStatusCode(404, 'Not Found');
        $response -> redirect('/'); 
        return $response;
    }

}

