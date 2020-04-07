<?php

class Entity 
{  
  public function __construct($params =null) {
    if (array_key_exists("id", $params)) {
      $table = get_class($this);
      $table = str_replace("Model", "s", $table);
      $table = strtolower($table);
      echo '✔ Key id exists on $params' . PHP_EOL;
      $params = ORM::read($table, $params["id"]);
      // var_dump($params);
    } else {
      echo '✖ Key id doesn\'t exists on $params' . PHP_EOL;
    }

    if ($params != false) {
      foreach ($params as $key => $value) {
        $this->$key = $value;
      }
    }


    // Relation entres les modeles
    $relations = $this->relations;
    // var_dump($relations);
    
    foreach ($relations["has many"] as $hasmany_arrays) {
      foreach ($hasmany_arrays as $fkey => $fvalue){
        if ($fkey == "table") {
          $value = $fvalue;
        } 
        elseif ($fkey == "key") {
          $column = $fvalue;
        }
      }
      // $this->$value = ORM::read($value, $this->id, $column);
      $model = ucfirst($value);
      $model = substr($model, 0, -1);
      $model .= "Model";
      echo '$value = ' . $value . PHP_EOL;
      echo '$model = ' . $model . PHP_EOL;
      $this->$value = new $model();
    }
    
  }
  
  public function save() {
    $table = get_class($this);
    $table = str_replace("Model", "s", $table);
    $table = strtolower($table);
    // echo $table . PHP_EOL;
    $arr = (array)$this;
    // var_dump($arr);

    $query = ORM::create($table, $arr);
    if ($query == true){
      echo "✔ Save with success 👍";
    }
  }
  
  //create (créé une nouvelle entrée en base avec les champs passés en paramètres et retourne son id)
  public function create($array =[null, null]) {
    // $db = new Database();
    // $sth = $db->connect();
    // // Ajoute un enregistrement en BDD avec les attributs du model
    // // $db->connect();

    // // $array = [$this->email, $this->password];

    // $q = $sth->prepare("INSERT INTO `users` (`id`, `email`, `pass`) VALUES (NULL, ?, ?);");
    // $q->execute($array);
    // $j = $sth->prepare("SELECT max(id) from users;");
    // $j->execute();

    // $results = $j->fetch(PDO::FETCH_NUM);
    // return $results;

    $table = get_class($this);
    $table = str_replace("Model", "s", $table);
    $table = strtolower($table);
    // echo $table . PHP_EOL;
    $arr = (array)$this;
    // var_dump($arr);

    $query = ORM::create($table, $arr);
    if ($query == true){
      echo "✔ Create with success 👍";
    }
  }


  // read (récupère une entrée en base suivant l’id de l’user)
  public function read($id) {
    // $db = new Database();
    // $sth = $db->connect();
    // // Ajoute un enregistrement en BDD avec les attributs du model
    // // $db->connect();
    // $j = $sth->prepare("SELECT * from users where id = ?;");
    // $j->execute(array($id));

    // // $results = $j->fetchAll(PDO::FETCH_NUM);
    // // var_dump($results);

    $table = get_class($this);
    $table = str_replace("Model", "s", $table);
    $table = strtolower($table);
    // echo $table . PHP_EOL;

    $query = ORM::read($table, $id);
    if ($query == true){
      echo "✔ Read with success 👍";
    }
  }

  //update (met à jour les champs d’une entrée en base suivant l’id de l’user)
  public function update($id, $email, $password) {
    // $db = new Database();
    // $sth = $db->connect();

    // $j = $sth->prepare("UPDATE users SET email = ?, pass = ? WHERE id = ?;");
    // $j->execute(array($email, $password, $id));

    $table = get_class($this);
    $table = str_replace("Model", "s", $table);
    $table = strtolower($table);
    // echo $table . PHP_EOL;
    $arr = (array)$this;
    // var_dump($arr);
    $fields = ["email" => $email, "pass" => $password];

    $query = ORM::update($table, $id, $fields);
    if ($query == true){
      echo "✔ Update with success 👍";
    }
  }

  // delete (supprime une entrée en base suivant l’id de l’user)
  public function delete($id) {
    // $db = new Database();
    // $sth = $db->connect();

    // $j = $sth->prepare("DELETE FROM users WHERE id= ?;");
    // $j->execute(array($id));

    $table = get_class($this);
    $table = str_replace("Model", "s", $table);
    $table = strtolower($table);
    // echo $table . PHP_EOL;

    $query = ORM::delete($table, $id);
    if ($query == true){
      echo "✔ Delete with success 👍";
    }
  }


  // read_all (récupère toutes les entrées de la table user)
  public function read_all() {
    $db = new Database();
    $sth = $db->connect();

    $j = $sth->prepare("SELECT * from users");
    $j->execute();

    $results = $j->fetchAll(PDO::FETCH_NUM);
    var_dump($results);
  }
}
