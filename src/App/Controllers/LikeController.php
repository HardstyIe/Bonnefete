<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/UserModel.php');
require_once('./src/App/Models/PostModel.php');
require_once('./src/App/Models/HomeModel.php');
require_once('./src/App/Models/LikeModel.php');

use Bonnefete\App\Models\UserModel;
use Bonnefete\App\Models\PostModel;
use Bonnefete\App\Models\HomeModel;
use Bonnefete\App\Models\LikeModel;


class LikeController
{
  protected $userModel;
  protected $postModel;

  protected $likeModel;

  protected $homeModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->postModel = new PostModel();
    $this->homeModel = new HomeModel();
    $this->likeModel = new LikeModel();
  }


  public function getLike()
  {
    require_once '../Bonnefete/src/App/Views/likes/like.php';
  }

  public function postLike()
  {
    $FK_post_id = $_POST['FK_post_id'];
    $FK_user_id = $_POST['FK_user_id'];

    $like = array(
      'FK_post_id' => $FK_post_id,
      'FK_user_id' => $FK_user_id
    );
    $message = $this->likeModel->createLike($like);
    echo $message;
    header('Location:/Bonnefete/home/index');
  }
  public function getDislike()
  {
    require_once '../Bonnefete/src/App/Views/likes/dislike.php';
  }

  public function postDislike()
  {
    $FK_post_id = $_POST['FK_post_id'];
    $FK_user_id = $_POST['FK_user_id'];

    $dislike = array(
      'FK_post_id' => $FK_post_id,
      'FK_user_id' => $FK_user_id
    );
    $message = $this->likeModel->deleteLike($dislike);
    echo $message;
    header('Location:/Bonnefete/home/index');
  }
}
