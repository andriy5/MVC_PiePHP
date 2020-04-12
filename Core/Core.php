<?php

namespace Core;

use Router;

class Core
{
  public function __construct()
  {
    require_once("src/routes.php");
  }

  public function run()
  {
    // echo "✔ " . __CLASS__ . " [OK]" . PHP_EOL;

    // echo $_SERVER["REDIRECT_URL"] . PHP_EOL;
    // var_dump(Router::$routes);

    $path = explode("/", $_SERVER["REDIRECT_URL"]);
    array_shift($path);
    array_shift($path);
    $path = implode("/", $path);


    // //STATIQUE
    if (($route = Router::get($path)) != null) {
      // echo "RENTRE DANS LE STATIQUE\n";

      
      $get = Router::getRoute($path);
      print_r($get);
      $controller = ucfirst($get["controller"]) . "Controller";
      $action = $get["action"] . "Action";
      
      $newcontroller = new $controller();
      $newcontroller->$action();
    } else {
      // echo "RENTRE DANS LA DYNAMIQUE\n";
      
      $check = Router::check($path);
      // var_dump($check);

      if ($check["check"] == true && is_numeric($check["value_from"])) {
        $path = str_replace($check["value_from"], $check["value_to"], $path);
        // echo $path. PHP_EOL;
        $get = Router::getRoute($path);
        // print_r($get);
        $controller = ucfirst($get["controller"]) . "Controller";
        $action = $get["action"] . "Action";

        $newcontroller = new $controller();
        $newcontroller->$action($check["value_from"]);
      } 
      else {
        $arr = explode('/', $_SERVER["REDIRECT_URL"]);
        // var_dump($arr);
        if (!empty($arr[2])) {
          $controller = ucfirst($arr[2]) . "Controller";
        } else {
          // echo "controller empty bro\n";
          $controller = "AppController";
        }
  
        if (!empty($arr[3])) {
          $action = $arr[3] . "Action";
        } else {
          // echo "action empty bro\n";
          $action = "indexAction";
        }
  
        // echo $controller . "->" . $action . PHP_EOL;
  
        if (class_exists($controller)) {
          $newcontroller = new $controller();
          if (method_exists($newcontroller, $action)) {
            $newcontroller->$action();
  
            // $view = "login";
            // $newcontroller->render($view);
          } else {
            echo "404";
          }
        } else {
          echo "404";
        }
      }

    }
  }
}
