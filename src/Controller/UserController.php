<?php

// use Core\ORM;

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

    // Mettre a jour les attr. du modelf3
    // $obj->email = $postemail;
    // $obj->password = $postpassword;

    // Appellez méthode save()
    // $obj->save();
    echo "✔ Rentre dans le registerAction\n";
    // ORM::create('users', array("email" => $_POST["email"], "pass" => $_POST["password"]));
    ORM::create('articles', array ('titre' => "un super titre", 'content' => 'et voici une super article de blog', 'author' => 'Rodrigue'));
    // ORM::read('users', 65);
    // ORM::update('users', 65, ["email" => "Balkany4", "password" => "bg4"]);
    // ORM::update('users', 65, ["email" => "Balkany4", "password" => "bg4"]);
    // ORM::delete('users', 64);
    // ORM::find('users', ["WHERE" => 65]);
    // $obj->read(65);
    // $obj->update(48, "testupdate", "mdp");
    // $obj->delete(47);
    // $obj->read_all();

  }
}
