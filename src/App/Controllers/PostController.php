<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/PostModel.php');
require_once('./src/App/Models/HomeModel.php');
require_once('./src/App/Models/LikeModel.php');

use Bonnefete\App\Models\PostModel;
use Bonnefete\App\Models\LikeModel;
use Bonnefete\App\Models\HomeModel;

class PostController
{
  protected $postModel;
  protected $homeModel;
  protected $likeModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
    $this->homeModel = new HomeModel();
    $this->likeModel = new LikeModel();
  }

  public function getCreate()
  {
    require_once '../Bonnefete/src/App/Views/posts/create.php';
  }

  public function postCreate()
  {
    $post = $_POST;
    $message = $this->postModel->createPost($post);
    header('Location: /bonnefete/home/index');
  }

  public function getCreateComment($id)
  {
    $posts = $this->homeModel->getPostById($id);
    require_once '../Bonnefete/src/App/Views/posts/createComment.php';
  }

  public function postCreateComment()
  {
    $comment = $_POST;
    $id = $_POST['FK_post_id'];
    $message = $this->postModel->createComment($comment);
    header("Location: /bonnefete/post/comment/$id");
  }

  public function getUpdate($id)
  {
    $post = $this->postModel->getPostById($id);
    require_once '../Bonnefete/src/App/Views/posts/update.php';
  }

  public function postUpdate()
  {
    $postId = $_POST['id']; // Récupérer l'identifiant du post depuis l'URL
    $post = $_POST;
    $post['id'] = $postId;
    $message = $this->postModel->updatePost($post);
    return $message;
  }

  public function getDelete($id)
  {
    $message = $this->postModel->deletePost($id);
    require_once '../Bonnefete/src/App/Views/posts/delete.php';
    header('Location: /bonnefete/home/index');
  }

  public function getComment($id)
  {
    $posts = $this->homeModel->getPostById($id);
    $comments = $this->homeModel->getCommentByPostId($id);
    require_once '../Bonnefete/src/App/Views/posts/comment.php';
  }
}
