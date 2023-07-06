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

  public function getLikes()
  {
    $sql = "SELECT likes.id,likes.FK_post_id,likes.FK_user_id FROM likes";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute();
    $likes = $query->fetchAll();
    return $likes;
  }
  // fait moi un getLikeByPost qui permet d'avoir un like selon l'utilisateur et le post visiter

  public function createLike($like)
  {
    $sql = "INSERT INTO likes (likes.FK_post_id,likes.FK_user_id) VALUES (:FK_post_id,:FK_user_id)";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'FK_post_id' => $like['FK_post_id'],
      'FK_user_id' => $like['FK_user_id']
    ]);
    return 'Like created';
  }

  public function deleteLike($like)
  {
    $sql = "DELETE FROM likes WHERE likes.FK_post_id = :FK_post_id AND likes.FK_user_id = :FK_user_id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'FK_post_id' => $like['FK_post_id'],
      'FK_user_id' => $like['FK_user_id']
    ]);
    return 'Like deleted';
  }
}
