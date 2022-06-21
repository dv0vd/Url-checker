<?php
declare(strict_types=1);

class AdminController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this -> view -> title = "Административная часть";
    }

    public function getUrlsAction() {
        $request = $this -> request;
        if($request -> isPost() && $request -> isAjax()) {
            $urls = Urls::find();
            return json_encode($urls);
        } else {
            $response = [["result" => false, "message" => "Неверный запрос"]];
            return json_encode($response);
        }
    }

    public function urlAction($id){
        echo $id;
    }

}

