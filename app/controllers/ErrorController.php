<?php
declare(strict_types=1);

class ErrorController extends \Phalcon\Mvc\Controller
{

    public function notFoundAction()
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->redirect('/');
    }

}

