<!--  fait moi la page like -->
<?php

namespace Bonnefete\App\Models;

require_once('./src/App/Models/LikeModel.php');

use Bonnefete\App\Models\LikeModel;

class Like
{
  protected $userId;

  protected $postId;

  public function __construct($userId, $postId)
  {
    $this->userId = $userId;
    $this->postId = $postId;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function getPostId()
  {
    return $this->postId;
  }

  public function setUserId($user)
  {
    $this->userId = $user;
  }

  public function setPostId($post)
  {
    $this->postId = $post;
  }
}