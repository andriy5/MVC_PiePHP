<pre>
<?php

define('BASE_URI', __DIR__  . DIRECTORY_SEPARATOR);

require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core();
$app->run();

// echo BASE_URI . "<br>";