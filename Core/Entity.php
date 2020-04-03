<?php

class Entity 
{  
  public function __construct($params) {
    if (array_key_exists("id", $params)) {
      echo '✔ Key id exists on $params' . PHP_EOL;
      $params = ORM::read('users', $params["id"]);
      // var_dump($params);
    } else {
      echo '✔ Key id doesn\'t exists on $params' . PHP_EOL;
    }

    foreach ($params as $key => $value) {
      $this->$key = $value;
    }
    var_dump($this);
  }
}
