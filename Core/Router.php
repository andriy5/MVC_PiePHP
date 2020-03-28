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
}
?>