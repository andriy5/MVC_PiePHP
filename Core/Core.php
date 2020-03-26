<?php

namespace Core;

class Core
{
  public function run()
  {
    echo __CLASS__ . " [OK]" . PHP_EOL;
    $arr = explode('/', $_SERVER["REDIRECT_URL"]);
    // var_dump($arr);
    $controller = ucfirst($arr[count($arr)-2]) . "Controller";
    $action = $arr[count($arr)-1] . "Action";

    // echo $controller . "->" . $action . PHP_EOL;
    // echo $action;
    // var_dump($_SERVER);
    if (class_exists($controller)) {
      $newcontroller = new $controller();
      $newcontroller->$action();
    }
    else {
      echo "ta mere";
    }
  }
}