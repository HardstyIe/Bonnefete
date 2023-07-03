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
    $sql = "SELECT Like_Id,FK_Post_Id,FK_User_Id FROM likes";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute();
    $likes = $query->fetchAll();
    return $likes;
  }
  // fait moi un getLikeByPost qui permet d'avoir un like selon l'utilisateur et le post visiter

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
}
