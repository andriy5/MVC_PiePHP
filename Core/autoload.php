<?php

spl_autoload_register(function ($class) {
  // echo str_replace('\\', '/', (BASE_URI . "$class.php")) . PHP_EOL;
  echo BASE_URI . PHP_EOL;
  echo $class . PHP_EOL;
  // echo BASE_URI . $class . PHP_EOL;
  // include str_replace('\\', '/', (BASE_URI . "$class.php"));
  $path = str_replace('\\', '/', (BASE_URI . "$class.php"));
  // include str_replace('\\', '/', (BASE_URI . "$class.php"));
  echo $path . PHP_EOL;
  if (!file_exists($path)){
    // echo "n'existe ap'";
    $path = str_replace('\\', '/', (BASE_URI . "src/Controller/$class.php"));
    echo $path;
    include $path;
  } else {
    include $path;
  }
});

?>