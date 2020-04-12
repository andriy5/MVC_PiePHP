<?php

// use Core\ORM;

class UserController extends Controller
{
  public function addAction()
  {
    $this->render("register");
  }

  public function indexAction()
  {
    $this->render("index");
  }

  public function registerAction()
  {
    echo "✔ Rentre dans le registerAction\n";
    // Instance UserModel
    // $obj = new UserModel($_POST["email"], $_POST["password"]);

    // Récup. la requête POST
    // $postemail = $_POST["email"];
    // $postpassword = $_POST["password"];

    // $obj->email = $_POST["email"];
    // $obj->password = $_POST["password"];

    // Mettre a jour les attr. du model
    // $obj->email = $postemail;
    // $obj->password = $postpassword;

    // Appellez méthode save()
    // $obj->save();
    // ORM::create('users', array("email" => $_POST["email"], "pass" => $_POST["password"]));
    // ORM::create('articles', array ('titre' => "un super titre", 'content' => 'et voici une super article de blog', 'author' => 'Rodrigue'));
    // ORM::read('users', 65);
    // ORM::update('users', 65, ["email" => "Balkany4", "password" => "bg4"]);
    // ORM::update('users', 65, ["email" => "Balkany4", "password" => "bg4"]);
    // ORM::delete('users', 64);
    // ORM::find('users', ["WHERE" => 65]);
    // $obj->read(65);
    // $obj->update(48, "testupdate", "mdp");
    // $obj->delete(47);
    // $obj->read_all();


    // var_dump($_REQUEST);
    $params = $this->request->getQueryParams();
    // $params = ["id" => 108];
    $user = new UserModel($params);
    if (!$user->id) {
      $user->save();
      self::$_render = "Votre compte a ete cree. 👏" . PHP_EOL;
    }
    echo self::$_render;
  }

  public function detailsAction ()
  {
    $user = new UserModel(["id" => 6]);
    echo PHP_EOL.PHP_EOL."🏆 RESULT (detailsAction):";
    // var_dump($user);
    var_dump($user->articles[0]);
    // var_dump($user->comments);
  }

  public function showAction($id) {
    echo "ID de l'utilisateur a afficher : $id" . PHP_EOL;
  }
}
