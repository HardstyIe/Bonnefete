<?php

namespace Bonnefete\App\Models;


use Bonnefete\Bootstrap\Database;


class HomeModel
{
  private $connection;
  public function __construct()
  {
    $this->connection = new Database();
  }

  public function getPosts()
  {
    $sql = "SELECT
    COUNT(likes.FK_User_Id) AS LikeCount,
    post.Post_Article,
    post.Post_Title,
    post.Post_CreateAt,
    post.Post_Id,
    post.FK_User_Id,
    user.User_Email,
    user.User_Name,
    user.User_Surname,
    likes.FK_User_Id AS LikeUserId,
    likes.FK_Post_Id AS LikePostId,
    IF (IF (likes.FK_User_Id=User_Id, 1, 0)=IF (likes.FK_Post_Id=post.Post_Id, 1, 0), 1, 0) AS isLiked
FROM
    post
INNER JOIN user
ON
    FK_User_Id = User_Id
LEFT JOIN likes
ON
    post.Post_Id = likes.FK_Post_Id
GROUP BY
    Post_Id,
    LikeUserId,
    LikePostId
ORDER BY
    Post_CreateAt
DESC;";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function getPostById($id)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt FROM post WHERE Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }


  public function getPostByUserId($id)
  {
    $sql = "SELECT Post_Title,Post_Article,Post_CreateAt FROM post WHERE User_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetchAll();
  }

  public function updatePost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE post SET Post_Title = :title, Post_Article = :article WHERE Post_Id = :id');
      $query->execute([
        'title' => $post['title'],
        'article' => $post['article'],
        'id' => $post['Post_Id']
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function deletePost($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM post WHERE Post_Id = :id');
      $query->execute([
        'id' => $id,
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }
}
