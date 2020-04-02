<?php

use Core\Request;

class Controller
{  
  public static $_render;

  public function __construct(){
    // require_once("Request.php");
    $request = new Request();
    $request->clean();
  }

  protected function render($view, $scope = []) {

    extract($scope);
    $f = implode (DIRECTORY_SEPARATOR, [dirname ( __DIR__ ), 'src', 'View', str_replace ('Controller' , '', basename (get_class($this))), $view ]) . '.php';
    // echo $f;
    if (file_exists ($f)) {
      ob_start ();
      include ($f);
      $view = ob_get_clean ();
      ob_start ();
      include (implode ( DIRECTORY_SEPARATOR, [dirname ( __DIR__ ), 'src', 'View', 'index']) . '.php');
      self::$_render = ob_get_clean();
      return self::$_render;
    }
  }
}
