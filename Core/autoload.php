<?php

spl_autoload_register(function ($class) {
  $path = str_replace('\\', '/', (BASE_URI . "$class.php"));
  if (!file_exists($path)){
    $path = str_replace('\\', '/', (BASE_URI . "src/$class.php"));
    if (file_exists($path)){
      include $path;
    }
  } else {
    include $path;
  }

    // $array = [
    //   BASE_URI,
    //   'src/Controller/'
    // ];
    // // var_dump($array);
    // for ($i=0; $i < count($array); $i++) { 
    //   // $classPath = "{$array[$i]}{$class}.php";
    //   $classPath =  str_replace('\\', '/', (BASE_URI . "{$array[$i]}{$class}.php"));
    //   // echo $classPath . PHP_EOL;
    //   if ( file_exists($classPath) ) {
    //     include $classPath;
    //   }
    //   else {
    //     $classPath =  str_replace('\\', '/', "{$array[$i]}{$class}.php");
    //     // echo $classPath . PHP_EOL;
    //     if ( file_exists($classPath) ) {
    //       include $classPath;
    //     }
    //   }
    // }
});

?>