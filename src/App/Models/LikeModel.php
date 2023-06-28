<!--  fait moi le LikeModel  -->
<?php

namespace Bonnefete\App\Models;

use Bonnefete\Bootstrap\Database;



class LikeModel
{
  private $connection;
  public function __construct()
  {
    $this->connection = new Database();
  }
  public function createLike($like)
  {
    $sql = "INSERT INTO likes (FK_User_Id, FK_Post_Id) VALUES (:user_id, :post_id)";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'user_id' => $like['user_id'],
      'post_id' => $like['post_id']
    ]);
  }

  public function deleteLike($like)
  {
    $sql = "DELETE FROM likes WHERE FK_User_Id = :user_id AND FK_Post_Id = :post_id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'user_id' => $like['user_id'],
      'post_id' => $like['post_id']
    ]);
  }

  public function getLike($like)
  {
    $sql = "SELECT Post_Id,User_Id FROM likes WHERE FK_User_Id = :user_id AND FK_Post_Id = :post_id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'user_id' => $like['user_id'],
      'post_id' => $like['post_id']
    ]);
    return $query->fetch();
  }

  public function getLikes($id)
  {
    $sql = "SELECT COUNT(FK_Post_Id) FROM likes WHERE FK_Post_Id = :post_id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'post_id' => $id
    ]);
    return $query->fetch();
  }
}