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
  public function getIndex()
  {
    $posts = $this->homeModel->getPosts();
    require_once '../Bonnefete/src/App/Views/homepages/index.php';
  }
}
