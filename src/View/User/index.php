<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index - User View</title>
</head>
<body>
  <pre>
  <?php
    echo '$_POST = ';
    var_dump($_POST);

    echo '<br>$_GET = ';
    var_dump($_GET);

    echo '<br>$_SERVER = ';
    var_dump($_SERVER);
  ?>
  
  </pre>
</body>
</html>