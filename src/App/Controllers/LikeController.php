<!-- generate a likeController page -->
<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/LikeModel.php');

use Bonnefete\App\Models\LikeModel;

class LikeController
{
  protected $likeModel;

  public function __construct()
  {
    $this->likeModel = new LikeModel();
  }

  public function getCreate()
  {
    require_once '../Bonnefete/src/App/Views/likes/create.php';
  }

  public function postCreate()
  {
    $like = $_POST;
    $message = $this->likeModel->createLike($like);
    header('Location: /bonnefete/home/index');
  }
}