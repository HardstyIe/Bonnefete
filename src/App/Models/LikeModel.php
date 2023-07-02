<?php

namespace Bonnefete\App\Models;

use Bonnefete\Bootstrap\Database;
use PDO;

class LikeModel
{

  private $connection;

  public function __construct()
  {
    $this->connection = new Database();
  }

  public function getLikes()
  {
    $sql = "SELECT Like_Id,FK_Post_Id,FK_User_Id FROM likes";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute();
    $likes = $query->fetchAll();
    return $likes;
  }

  public function getLikesByPostId($id)
  {
    $sql = "SELECT Like_Id,FK_Post_Id,FK_User_Id,COUNT(FK_Post_Id) as Like_Count FROM likes WHERE FK_Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);

    $query->execute(['id' => $id]);
    $likes = $query->fetch();
    var_dump($likes);
    return $likes;
  }

  public function getLikesByUserId($id)
  {
    $sql = "SELECT Like_Id,FK_Post_Id,FK_User_Id FROM likes WHERE FK_User_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    $likes = $query->fetchAll();
    return $likes;
  }

  public function getLikeById($id)
  {
    $sql = "SELECT Like_Id,FK_Post_Id,FK_User_Id FROM likes WHERE Like_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    $like = $query->fetch();
    return $like;
  }

  public function createLike($like)
  {
    $sql = "INSERT INTO likes (FK_Post_Id,FK_User_Id) VALUES (:FK_Post_Id,:FK_User_Id)";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'FK_Post_Id' => $like['FK_Post_Id'],
      'FK_User_Id' => $like['FK_User_Id']
    ]);
    return 'Like created';
  }

  public function deleteLike($like)
  {
    $sql = "DELETE FROM likes WHERE FK_Post_Id = :FK_Post_Id AND FK_User_Id = :FK_User_Id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'FK_Post_Id' => $like['FK_Post_Id'],
      'FK_User_Id' => $like['FK_User_Id']
    ]);
    return 'Like deleted';
  }

  public function isLiked($postId, $userId)
  {
    $sql = "SELECT COUNT(Like_Id) as likeCount FROM likes WHERE FK_Post_Id = :postId AND FK_User_Id = :userId";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'postId' => $postId,
      'userId' => $userId
    ]);

    $result = $query->fetch(PDO::FETCH_ASSOC);
    $likeCount = $result['likeCount'];

    return ($likeCount > 0);
  }
}
