<?php

class UserModel {
  private $email;
  private $password;

  public function __construct($email, $pass)
  {
    $this->email = $email;
    $this->password = $pass;
  }
  
  public function save() {
    // Ajoute un enregistrement en BDD avec les attributs du model
    // $db->connect();
    $db = new Database();
    $sth = $db->connect();

    $array = [$this->email, $this->password];

    $q = $sth->prepare("INSERT INTO `users` (`id`, `email`, `password`) VALUES (NULL, ?, ?);");
    $q->execute($array);
    echo "Save with success 👍";
  }
}