<?php

namespace Bonnefete\App\Controllers;

require('./src/App/Models/HomeModel.php');

use Bonnefete\App\Models\HomeModel;

class HomeController
{

  protected $homeModel;

  public function __construct()
  {
    $this->homeModel = new HomeModel();
  }


  //  make me a getIndex that retrieve all my user and post 

  public function getIndex()
  {
    $posts = $this->homeModel->getPosts();
    require_once '../Bonnefete/src/App/Views/homepages/index.php';
  }

  // make me a getPostByUser that retrieve all the post for 1 User using the getpostbyuser function

  public function getPostByUser()
  {
    $postCounts = $this->homeModel->getPosts();
    require_once '../Bonnefete/src/App/Views/homepages/index.php';
  }
}
