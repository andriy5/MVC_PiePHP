<?php

class Router
{
  private static $routes;
  
  public static function connect($url, $route)
  {
    // echo "function connect du Router appelé\n";
    self::$routes[$url] = $route;
  }

  public static function get($url) 
  {
    // echo "function get du Router appelé\n";
    return array_key_exists($url, self::$routes) ? self::$routes[$url] : null;
  }

  public static function getRoute($url)
  {
    return self::$routes[$url];
  }

  public static function check($url) {
    foreach (self::$routes as $key => $value) {
      $route = explode('/', $key);
      // var_dump($route);
      foreach ($route as $skey => $svalue) {
        // echo $svalue.PHP_EOL;
        if ($svalue == "{id}") {
          // echo "⭐ ". $skey. PHP_EOL;
          $i = $skey;
          $explode = explode('/', $url);
          // var_dump($explode);
          // echo "URL -> $url".PHP_EOL;
          // echo $explode[$i].PHP_EOL;
          return ["check" => true, "value_from" => $explode[$i], "value_to" => $svalue , "position" => $i];
        }
      }
    }


  }
}

