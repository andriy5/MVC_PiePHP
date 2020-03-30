<?php

class UserController extends Controller
{
  public function addAction()
  {
    echo $this->render("register");
  }

  public function indexAction()
  {
    echo $this->render("index");
  }

  public function registerAction()
  {
    // Instance UserModel
    $obj = new UserModel($_POST["email"], $_POST["password"]);

    // Récup. la requête POST
    // $postemail = $_POST["email"];
    // $postpassword = $_POST["password"];

    // $obj->email = $_POST["email"];
    // $obj->password = $_POST["password"];

    // Mettre a jour les attr. du model
    // $obj->email = $postemail;
    // $obj->password = $postpassword;

    // Appellez méthode save()
    $obj->save();
  }
}
