<?php
declare(strict_types=1);


use Phalcon\Validation;
use Phalcon\Validation\Validator\Url;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Digit;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Between;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this -> view -> title = "Сервис проверки доступности url-ов";
    }

    public function addUrlAction(){
        $request = $this -> request;
        if($request -> isPost() && $request -> isAjax()) {
            $test = new Url();
            $messages = $this -> validation(0);
            if (count($messages)) {
                $response = [];
                foreach ($messages as $message) {
                    array_push($response, $message);
                }
                return json_encode($response);
            }

            $url = Urls::findByUrl($request -> getPost("url"));
            if(count($url) > 0) {
                $response = [["result" => false, "message" => "Данный url уже присутствует в базе данных!"]];
                return json_encode($response);
            } else {
                $url = new Urls();
                $url -> freq = $request -> getPost('freq');
                $url -> repeats = $request -> getPost('repeats');
                $url -> url = $request -> getPost('url');
                $url -> datetime = date('Y-m-d H:i:s');
                if($url -> save()) {
                    $response = [["result" => true, "message" => "Успех!"]];
                    return json_encode($response);
                } else{
                    $messages = $url->getMessages();
                    foreach ($messages as $message) {
                        array_push($response, $message);
                    }
                    return json_encode($response);
                }
            }
        } else {
            $response = [["result" => false, "message" => "Неверный запрос"]];
            return json_encode($response);
        }
    }

    private function validation($type){
        $validation = new Validation();
        switch($type) {
            case 0:
              $validation -> add(
                'url', new PresenceOf([
                    'message' => 'Отсутствует URL!',
                ])
              );
              $validation -> add(
                'url', new Url([
                    'message' => 'Неверный URL!',
                ])
              );
              $validation -> add(
                'freq', new PresenceOf([
                    'message' => 'Отсутствует частота проверки!',
                ])
              );
              $validation -> add(
                'freq', new Digit([
                    'message' => 'Частота проверки должна быть числом!',
                ])
              );
              $validation->add(
                "freq", new InclusionIn([
                    "message" => "Частота проверки должна быть 1, 5 или 10 мин!",
                    "domain"  => [
                        "1",
                        "5",
                        "10"
                    ],
                ])
            );
              $validation -> add(
                'repeats', new PresenceOf([
                    'message' => 'Отсутствует количество повторов!',
                ])
              );
              $validation -> add(
                'repeats', new Digit([
                    'message' => 'Количество повторов должно быть числом!',
                ])
              );
              $validation -> add(
                "repeats", new Between([
                    "minimum" => 0,
                    "maximum" => 10,
                    "message" => "Количество повторов должно быть от 0 до 10!",
                ])
              );
            break;
        }
        return $validation -> validate($_POST);
    }
}

