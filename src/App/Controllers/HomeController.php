<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/HomeModel.php');
require_once('./src/App/Models/UserModel.php');

use Bonnefete\App\Models\HomeModel;
use Bonnefete\App\Models\UserModel;

class HomeController
{

  protected $homeModel;
  protected $userModel;

  public function __construct()
  {
    $this->homeModel = new HomeModel();
    $this->userModel = new UserModel();
  }

  public function getIndex()
  {
    $posts = $this->homeModel->getPosts();
    $user = $this->userModel->getOneByEmail($_SESSION['user']['User_Email']);
    require_once '../Bonnefete/src/App/Views/homepages/index.php';
  }

  public function getPostByUser()
  {
    $postCounts = $this->homeModel->getPosts();
    require_once '../Bonnefete/src/App/Views/homepages/index.php';
  }
}
