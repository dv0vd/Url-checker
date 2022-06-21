<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this -> view -> title = "Сервис проверки доступности url-ов";
    }

    public function addUrlAction(){
        $response = ["result" => true, "message" => "OK"];
        return json_encode($result);
    }

}

