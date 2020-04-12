<?php

// Routage parametrique
Router::connect("user/{id}", ["controller" => "user", "action" => "show"]);

Router::connect("test/test", ["controller" => "user", "action" => "index"]);
Router::connect("user/wesh", ["controller" => "user", "action" => "add"]);
Router::connect("user/wesh/", ["controller" => "user", "action" => "add"]);
Router::connect ('', ['controller' => 'app', 'action' => 'index']);
Router::connect ('register', ['controller' => 'user', 'action' => 'add']);
Router::connect ('register/', ['controller' => 'user', 'action' => 'add']);


