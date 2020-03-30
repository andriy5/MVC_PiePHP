<?php

spl_autoload_register(function ($class) {
  // echo PHP_EOL . PHP_EOL . "autoload ==>" . $class . PHP_EOL;

  // $path = str_replace('\\', '/', ("Core/$class.php"));
  
  // if (!file_exists($path)){

  //   $path = str_replace('\\', '/', ("src/Controller/$class.php"));
  //   // echo $path . PHP_EOL;
    
  //   if (!file_exists($path)){
      
  //     $path = str_replace('\\', '/', ("$class.php"));
      
  //     if (file_exists($path)){
  //       echo $path . PHP_EOL;
  //       include $path; 
  //     } 
  //   }
  //   else {
  //     echo $path . PHP_EOL;

  //     include $path;
  //   }
  // } 
  // else {
  //   echo $path . PHP_EOL;

  //   include $path;
  // }



  /* AVEC UN TABLEAU */
  $array = [
    "Core/",
    "src/Controller/",
    "",
    "src/",
    "src/Model/"
  ];

  for ($i=0; $i < count($array); $i++){
    $path = str_replace('\\', '/', ("{$array[$i]}{$class}.php"));
    if (file_exists($path)){
      // echo $path . PHP_EOL;
      include $path;
    }
  }
});

