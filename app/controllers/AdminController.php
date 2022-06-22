<?php
declare(strict_types=1);

use Phalcon\Mvc\View;

class AdminController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this -> view -> title = "Административная часть";
    }

    public function getUrlsAction() {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $request = $this -> request;
        if($request -> isPost() && $request -> isAjax()) {
            $urls = Urls::find();
            return json_encode($urls);
        } else {
            $response = [["result" => false, "message" => "Неверный запрос"]];
            return json_encode($response);
        }
    }

    public function urlAction($url_id){
        $url = Urls::findFirstByUrlId($url_id);
        $this -> view -> url = $url;
        $this -> view -> title = $url -> url;
    }

    public function getCheckInfoAction($url_id) {
        $request = $this -> request;
        if($request -> isPost() && $request -> isAjax()) {
            $check = Checks::findByUrlId($url_id);
            return json_encode($check);
        } else {
            $response = [["result" => false, "message" => "Неверный запрос"]];
            return json_encode($response);
        }
        
    }

    public function removeUrlAction($url_id) {
        $url = Urls::findFirstByUrlId($url_id);
        if($url != null) {
            $url -> delete();
            $response = ["result" => true, "message" => "Успех!"];
            return json_encode($response);
        } else {
            $response = ["result" => false, "message" => "Url с данным id не существует!"];
            return json_encode($response);
        }
    }

}

