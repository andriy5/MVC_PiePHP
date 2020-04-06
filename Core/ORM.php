<?php

// namespace Core;
// use Database;

Class ORM
{
  // public function __construct()
  // {
  //   // require_once("Database.php");
  // }

  public static function create ($table, $fields) {
    // Retourne un id
    $db = new Database();
    $sth = $db->connect();
    $array = [];
    $champs = "(id, ";
    $values = "(NULL, ";

    // echo "field :";
    // var_dump($fields);

    foreach ($fields as $key => $value) {
      if ($key == "password") {
        $key = "pass";
      }
      $champs .= $key . ", ";
      array_push($array, $value);
      // echo $key . "\n";
    }
    $champs = substr($champs, 0, -2);
    $champs .= ")";
    // echo $champs . "\n";
    
    for ($i=1; $i<=count($fields); $i++) {
      if ($i < count($fields)) {
        $values .= "?, ";
      }
      else {
        $values .= "?)";
      }
    }
    // echo $values;
    // var_dump($array);

    $q = $sth->prepare("INSERT INTO $table $champs VALUES $values;");
    $q->execute($array);
    $j = $sth->prepare("SELECT max(id) as result from $table;");
    // $j->execute($arraybis);
    $j->execute();

    $results = $j->fetch();
    // echo $results[0];
    return $results["result"];
  }

  public static function read ($table, $id =null) {
    // Retourne un tab. assoc. de l ' enregistrement
    $db = new Database();
    $sth = $db->connect();
    $array = [$id];

    $q = $sth->prepare("SELECT * FROM $table where id = ?");
    $q->execute($array);

    $results = $q->fetch(PDO::FETCH_ASSOC);
    return $results;
  }
  
  public static function update ($table, $id, $fields) {
    // Retourne un boolean
    $db = new Database();
    $sth = $db->connect();
    $check_array = [];

    foreach ($fields as $key => $value) {
      if ($key == "password") {
        $key = "pass";
      }
      $j = $sth->prepare("UPDATE $table SET $key = ? WHERE id = ?;");
      array_push($check_array, $j->execute(array($value, $id)));
    }
    foreach ($check_array as $val) {
      if ($val == false){
        return false;
      }
    }
    return true;
  }

  public static function delete ($table, $id=null) {
    // Retourne un boolean
    $db = new Database();
    $sth = $db->connect();
    $array = [$id];

    $q = $sth->prepare("DELETE FROM $table WHERE id = ?;");
    return $q->execute($array);
  }

  public static function find ($table, $params = array ('WHERE' => '1', 'ORDER BY' => 'id ASC', 'LIMIT' => '')) {
    // Retourne un tableau d'enregistrements
    $db = new Database();
    $sth = $db->connect();

    
    if ($params["ORDER BY"] == null){
      $params["ORDER BY"] = "id ASC";
    }


    if ($params["LIMIT"] == ""){
      $array = [$params["WHERE"], $params["ORDER BY"]];

      $q = $sth->prepare("SELECT * from $table WHERE id = ? ORDER BY ?");
      $q->execute($array);
      $results = $q->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }
    else {
      $array = [$params["WHERE"], $params["ORDER BY"], $params["LIMIT"]];

      $q = $sth->prepare("SELECT * from $table WHERE id = ? ORDER BY ? LIMIT ?");
      $q->execute($array);
      $results = $q->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    }
  }

}
