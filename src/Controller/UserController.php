<?php

class UserController extends Controller{
  public function addAction() {
    echo "** addAction appelé **\n";
  }

  public function indexAction() {
    echo $this->render("index");
  }

  public function registerAction() {
    // Instance UserModel
    $obj = new UserModel();
    
    // Récup. la requête POST
    $postemail = $_POST["email"];
    $postpassword = $_POST["password"];

    // Mettre a jour les attr. du model
    $obj->$email = $postemail;
    $obj->$password = $postpassword;

    // Appellez méthode save()
    $obj->save();
  }
}


?>