<?php

class Entity 
{  
  public function __construct($params=null, $condition=null, $position=null) {
    // echo "🚨🚨 Lancement Construct". PHP_EOL;
    // Check si "id" daans $params, si oui return un array avec toutes les infos de cette id
    if (array_key_exists("id", $params)) {
      $table = get_class($this);
      $table = str_replace("Model", "s", $table);
      $table = strtolower($table);
      // echo '✔ Key id exists on $params' . PHP_EOL;
      if ($condition == null){
        $params = ORM::read($table, $params["id"]);
      }
      else {
        $params = ORM::read($table, $params["id"], $condition, $position);
      }
      // var_dump($params);
    } else {
      // echo '✖ Key id doesn\'t exists on $params' . PHP_EOL;
    }
    // echo "🛎 $table".PHP_EOL;

    // Cree les attributs si $params a bien recup un tableau precedement
    if ($params != false) {
      foreach ($params as $key => $value) {
        $this->$key = $value;
      }
    }
    // echo "condition: $condition" . PHP_EOL;

    // Relation entres les modeles
    if ($this->relations) {
      $relations = $this->relations;
      // echo "relation:";
      // var_dump($relations["has many"]);

      foreach ($relations as $rkey => $rvalue) {

        if ($rkey == "has many"){
          foreach ($relations["has many"] as $hasmany_arrays) {
            // echo "  foreach\n";
            // var_dump($hasmany_arrays);
    
            // Definis mes var. values + column
            $value = $hasmany_arrays["table"];
            $column = $hasmany_arrays['key'];
    
            // Donne la var count (pour ensuite creer chaque model)
            // $result = ORM::read($value, $params["id"], $column, "all");
            // echo "⭐ result:";
            // var_dump($result);
            $count = count(ORM::read($value, $params["id"], $column, "all"));
            // echo "📌 count = $count" .PHP_EOL;
    
            // Definis $model
            $model = ucfirst($value);
            $model = substr($model, 0, -1);
            $model .= "Model";
            // echo '$model = ' . $model . PHP_EOL;
            // echo '$column = ' . $column . PHP_EOL . "--".PHP_EOL;  
    
            // Creer chaque model
            if ($count > 0) {
              for ($i=0; $i < $count; $i++) { 
                // echo PHP_EOL . "---- FIN du construct ----".PHP_EOL.PHP_EOL.PHP_EOL;
                $this->$value[$i] = new $model(["id" => $this->id], $column, $i);
              }
            }
          }
        }


        // elseif ($rkey == "has one") {
        //   foreach ($relations["has one"] as $hasone_arrays) {
        //     // echo "  foreach\n";
        //     // var_dump($hasone_arrays);
    
        //     // Definis mes var. values + column
        //     $name = $hasone_arrays["table_ref"];
        //     $value = $hasone_arrays["table"];
        //     $column = $hasone_arrays['key'];
    
        //     // Donne la var count (pour ensuite creer chaque model)
        //     echo PHP_EOL.'$value = ' . $value . PHP_EOL;
        //     echo '$params[id] = ' . $params["id"] . PHP_EOL;
        //     echo '$column = ' . $column . PHP_EOL;

        //     $count = ORM::read($value, $params["id"], $column, null);
        //     var_dump($count);

        //     // Definis $model
        //     $model = ucfirst($name);
        //     $model = substr($model, 0, -1);
        //     $model .= "Model";
        //     echo '$model = ' . $model . PHP_EOL;
        //     echo '$this->id = ' .$this->id.PHP_EOL;
        //     // echo '$column = ' . $column . PHP_EOL . "--".PHP_EOL;  
    
        //     // Creer chaque model
        //     // $this->$name = new $model(["id" => $this->id]);
        //     $this->$name = "test";
        //   }
        // }


        elseif ($rkey == "many to many") {
          // echo "many to many\n";
          foreach ($relations["many to many"] as $hasmany_arrays) {
            // echo "  foreach\n";
            var_dump($hasmany_arrays);
    
            // $this->$name = new $model(["id" => $this->id]);
            
          }
        }

      }

      // foreach ($relations["has many"] as $hasmany_arrays) {
      //   // echo "  foreach\n";
      //   // var_dump($hasmany_arrays);

      //   // Definis mes var. values + column
      //   $value = $hasmany_arrays["table"];
      //   $column = $hasmany_arrays['key'];

      //   // Donne la var count (pour ensuite creer chaque model)
      //   // $result = ORM::read($value, $params["id"], $column, "all");
      //   // echo "⭐ result:";
      //   // var_dump($result);
      //   $count = count(ORM::read($value, $params["id"], $column, "all"));
      //   // echo "📌 count = $count" .PHP_EOL;

      //   // Definis $model
      //   $model = ucfirst($value);
      //   $model = substr($model, 0, -1);
      //   $model .= "Model";
      //   // echo '$model = ' . $model . PHP_EOL;
      //   // echo '$column = ' . $column . PHP_EOL . "--".PHP_EOL;  

      //   // Creer chaque model
      //   if ($count > 0) {
      //     for ($i=0; $i < $count; $i++) { 
      //       // echo PHP_EOL . "---- FIN du construct ----".PHP_EOL.PHP_EOL.PHP_EOL;
      //       $this->$value[$i] = new $model(["id" => $this->id], $column, $i);
      //     }
      //   }
      // }
    }
      // echo '$value = ' . $value . PHP_EOL;
      // echo '$i = ' . $i . PHP_EOL; 
        
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
