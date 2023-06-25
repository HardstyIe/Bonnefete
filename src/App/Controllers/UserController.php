<?php

namespace App\Controllers;

require_once('Models/UserModel.php');

use App\Models\UserModel;

class UserController
{
  protected $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }
  public function getRegister()
  {
    require_once 'Views/user/register.php';
  }

  public function postRegister()
  {
    $user = $_POST;
    $message = $this->userModel->createUser($user);
    echo $message;
    echo '<a href="../user/login"> Se Connecter </a>';
  }

  public function getLogin()
  {
    require_once 'Views/user/login.php';
  }

  public function postLogin()
  {
    $this->userModel = new UserModel();
    $user = $this->userModel->getOneByEmail($_POST['email']);
    if ($user && password_verify($_POST['password'], $user->password)) {
      $_SESSION['user'] = $user;
      header('Location: /php-crud/char/index');
    } else {
      header('Location: /php-crud/user/register');
    }
  }

  public function getLogout()
  {
    session_destroy();
    header('Location: /php-crud/char/index');
  }
}
