<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/HomeModel.php');
require_once('./src/App/Models/UserModel.php');
require_once('./src/App/Models/LikeModel.php');

use Bonnefete\App\Models\HomeModel;
use Bonnefete\App\Models\UserModel;
use Bonnefete\App\Models\LikeModel;

class HomeController
{

  protected $homeModel;
  protected $userModel;

  protected $likeModel;

  public function __construct()
  {
    $this->homeModel = new HomeModel();
    $this->userModel = new UserModel();
    $this->likeModel = new LikeModel();
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

  public function getComment($id)
  {
    $post = $this->homeModel->getPostById($id);
    $comments = $this->homeModel->getCommentByPostId($id);
    require_once '../Bonnefete/src/App/Views/posts/comment.php';
  }

  public function postComment()
  {
    $FK_Post_Id = $_POST['FK_Post_Id'];
    $FK_User_Id = $_POST['FK_User_Id'];
    $Comment_Content = $_POST['Comment_Content'];

    $comment = array(
      'FK_Post_Id' => $FK_Post_Id,
      'FK_User_Id' => $FK_User_Id,
      'Comment_Content' => $Comment_Content
    );
    $message = $this->homeModel->createComment($comment);
    echo $message;
    header('Location:/Bonnefete/home/index');
  }
}
