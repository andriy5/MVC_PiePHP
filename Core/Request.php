<?php

namespace Core;

class Request
{
  public function clean(){
    foreach ($_POST as $value) {
      trim($value);
      stripslashes($value);
    }
    foreach ($_GET as $value) {
      trim($value);
      stripslashes($value);
    }
  }
}