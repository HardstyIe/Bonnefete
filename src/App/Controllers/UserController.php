<?php

namespace Bonnefete\App\Controllers;


require_once('./src/App/Models/UserModel.php');
require_once('./src/App/Models/PostModel.php');
require_once('./src/App/Models/HomeModel.php');

use Bonnefete\App\Models\UserModel;
use Bonnefete\App\Models\PostModel;
use Bonnefete\App\Models\HomeModel;

class UserController
{
  protected $userModel;
  protected $postModel;

  protected $homeModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->postModel = new PostModel();
    $this->homeModel = new HomeModel();
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


  public function getMyProfile()
  {
    $user = $this->userModel->getOneByEmail($_SESSION['user']['User_Email']);
    $post = $this->postModel->getAllUserPost($user);

    require_once '../Bonnefete/src/App/Views/users/profile.php';
  }

  public function getProfile($id)
  {
    $user = $this->userModel->getOneById($id);
    $post = $this->postModel->getAllUserPost($user);
    require_once '../Bonnefete/src/App/Views/users/profile.php';
  }

  public function postProfile()
  {
    $user = $_POST;
    $message = $this->userModel->updateUser($user);
    echo $message;
    header('Location: /bonnefete/user/profile');
  }

  public function getDelete()
  {
    $user = $this->userModel->getOneByEmail($_SESSION['user']['User_Email']);
    require_once '../Bonnefete/src/App/Views/users/delete.php';
  }

  public function postDelete()
  {
    $user = $_POST;
    $message = $this->userModel->deleteUser($user);
    echo $message;
    header('Location: /bonnefete/user/login');
  }


  public function getUserList()
  {
    $users = $this->userModel->getUserListWithPostCount();
    require_once '../Bonnefete/src/App/Views/users/userList.php';
  }

  public function getPostByUser($id)
  {
    $user = $this->userModel->getOneById($id);
    $post = $this->postModel->getAllUserPost($user);
    require_once '../Bonnefete/src/App/Views/users/userList.php';
  }
}
