<?php

class Controller
{  
  public static $_render;

  protected function render($view, $scope = []) {
    /* Tests */
    // echo "\nentre dans le render()\n";
    // echo $view;
    // print_r($scope);


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


?>