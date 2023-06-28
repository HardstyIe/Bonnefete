<?php

namespace Bonnefete\App\Controllers;


require_once('./src/App/Models/UserModel.php');

use Bonnefete\App\Models\UserModel;

class UserController
{
  protected $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }
  public function getRegister()
  {
    require_once '../Bonnefete/src/App/Views/users/register.php';
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
    require_once '../Bonnefete/src/App/Views/users/login.php';
  }


  public function postLogin()
  {
    $user = $_POST;
    $message = $this->userModel->loginUser($user);
    echo $message;
    header('Location: /bonnefete/home/index');
  }


  public function getLogout()
  {
    $this->userModel->logoutUser();
    header('Location: /bonnefete/user/login');
  }


  public function getProfile()
  {
    $user = $this->userModel->getOneByEmail($_SESSION['user']['User_Email']);
    require_once '../Bonnefete/src/App/Views/users/profile.php';
  }


  public function postProfile()
  {
    $user = $_POST;
    $message = $this->userModel->updateUser($user);
    echo $message;
    header('Location: /bonnefete/user/profile');
  }
}