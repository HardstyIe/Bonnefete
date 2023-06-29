<?php

namespace Bonnefete\App\Controllers;

require_once('./src/App/Models/PostModel.php');

use Bonnefete\App\Models\PostModel;

class PostController
{
  protected $postModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
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

  public function postUpdate()
  {
    $post = $_POST;
    $message = $this->postModel->updatePost($post);
    header('Location: /bonnefete/home/index');
  }



  public function postDelete()
  {
    $post = $_POST;
    $message = $this->postModel->deletePost($post);
    header('Location: /bonnefete/home/index');
  }
}
