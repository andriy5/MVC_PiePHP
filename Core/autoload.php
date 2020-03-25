<?php

spl_autoload_register(function ($class) {
  include str_replace('\\', '/', (BASE_URI . "$class.php"));
});

?>