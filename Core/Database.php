<?php


class Database
{
  private $dsn = 'mysql:host=localhost;dbname=PiePHP';
  private $username = 'root';
  private $password = '';
  
  
  function connect() {
    try {
      $db = new PDO($this->dsn, $this->username);
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      // print_r("✔ Connection PDO established: You're good man !\n");
      return $db;
    } catch (PDOException $e) {
      die( 'Query failed: ' . $e->getMessage() );
    }
  }
}
