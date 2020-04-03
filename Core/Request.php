<?php

namespace Core;

class Request
{
  public function clean(){
    foreach ($_POST as $key => $value) {
      // $newvalue = trim($value);
      $newvalue = htmlspecialchars(stripslashes(trim($value)));
      $_POST[$key] = $newvalue;
    }
    foreach ($_GET as $key => $value) {
      // $newvalue = trim($value);
      $newvalue = htmlspecialchars(stripslashes(trim($value)));
      $_GET[$key] = $newvalue;
    }
  }

  public function getQueryParams(){
    echo "✔ getQueryParams()\n";
    // var_dump($_REQUEST);
    return $_REQUEST;
  }
}