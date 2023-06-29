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


  public function getUpdate($id)
  {
    $post = $this->postModel->getPostById($id);
    $message = $this->postModel->updatePost($post);
    require_once '../Bonnefete/src/App/Views/posts/update.php';
  }

  public function postUpdate()
  {
    $post = $_POST;
    $message = $this->postModel->updatePost($post);
    header('Location: /bonnefete/home/index');
  }
  public function getDelete($id)
  {
    $message = $this->postModel->deletePost($id);
    require_once '../Bonnefete/src/App/Views/posts/delete.php';
    header('Location: /bonnefete/home/index');
  }
}
