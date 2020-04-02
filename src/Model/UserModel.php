<?php

class UserModel extends Entity {
  private $email;
  private $password;

  public function __construct($email, $pass)
  {
    $this->email = $email;
    $this->password = $pass;
  }
  
  public function save() {
    $db = new Database();
    $sth = $db->connect();
    // Ajoute un enregistrement en BDD avec les attributs du model
    // $db->connect();

    $array = [$this->email, $this->password];

    $q = $sth->prepare("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, ?, ?);");
    $q->execute($array);
    echo "Save with success 👍";
  }

  //create (créé une nouvelle entrée en base avec les champs passés en paramètres et retourne son id)
  public function create($array =[null, null]) {
    $db = new Database();
    $sth = $db->connect();
    // Ajoute un enregistrement en BDD avec les attributs du model
    // $db->connect();

    // $array = [$this->email, $this->password];

    $q = $sth->prepare("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, ?, ?);");
    $q->execute($array);
    $j = $sth->prepare("SELECT max(id) from users;");
    $j->execute();

    $results = $j->fetch(PDO::FETCH_NUM);
    return $results;

    // $q->debugDumpParams();
  }


  // read (récupère une entrée en base suivant l’id de l’user)
  public function read($id) {
    $db = new Database();
    $sth = $db->connect();
    // Ajoute un enregistrement en BDD avec les attributs du model
    // $db->connect();
    $j = $sth->prepare("SELECT * from users where id = ?;");
    $j->execute(array($id));

    // $results = $j->fetchAll(PDO::FETCH_NUM);
    // var_dump($results);

    // $q->debugDumpParams();
  }

  //update (met à jour les champs d’une entrée en base suivant l’id de l’user)
  public function update($id, $email, $password) {
    $db = new Database();
    $sth = $db->connect();

    $j = $sth->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?;");
    $j->execute(array($email, $password, $id));

    // $q->debugDumpParams();
  }

  // delete (supprime une entrée en base suivant l’id de l’user)
  public function delete($id) {
    $db = new Database();
    $sth = $db->connect();

    $j = $sth->prepare("DELETE FROM users WHERE id= ?;");
    $j->execute(array($id));

    // $q->debugDumpParams();
  }


  // read_all (récupère toutes les entrées de la table user)
  public function read_all() {
    $db = new Database();
    $sth = $db->connect();

    $j = $sth->prepare("SELECT * from users");
    $j->execute();

    $results = $j->fetchAll(PDO::FETCH_NUM);
    var_dump($results);

    // $q->debugDumpParams();
  }

}