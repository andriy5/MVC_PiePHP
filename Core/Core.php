<?php

namespace Core;
use Router;

class Core
{
  public function __construct() {
    require_once("src/routes.php");
  }

  public function run()
  {
    echo __CLASS__ . " [OK]" . PHP_EOL;
    // var_dump(Router::get("test/test"));
    // //STATIQUE
    if ($route = Router::get("test/test") != null) {
      echo "pas null enfin bref";
    }
    else {
      // DYNAMIQUE
      $arr = explode('/', $_SERVER["REDIRECT_URL"]);
      // var_dump($arr);
      if (!empty($arr[2])) {
        $controller = 'Controller\\' . ucfirst($arr[2]) . "Controller";
      }
      else {
        $controller = "Controller\AppController";
      }
      
      if (!empty($arr[3])) {
        $action = $arr[3] . "Action";
      }
      else {
        $action = "indexAction";
      }
  
      if (class_exists($controller)){
        $newcontroller = new $controller();
        if (method_exists($newcontroller, $action)){
          $newcontroller->$action();
        }
        else {
          echo "404";
        }
      }
      else {
        echo "404";
      }
    }

  }
}