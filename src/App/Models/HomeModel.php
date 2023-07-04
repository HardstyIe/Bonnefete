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
    IF (IF (likes.FK_User_Id=:userId, 1, 0)=IF (likes.FK_Post_Id=post.Post_Id, 1, 0), 1, 0) AS isLiked,
    images.Image_Name
  FROM
    post
  INNER JOIN user
    ON FK_User_Id = User_Id
  LEFT JOIN likes
    ON post.Post_Id = likes.FK_Post_Id
  LEFT JOIN images
    ON post.FK_Image_Id = images.Image_Id
  GROUP BY
    Post_Id,
    LikeUserId,
    LikePostId
  ORDER BY
    Post_CreateAt DESC;";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(
      [
        'userId' => $_SESSION['user']['User_Id']
      ]
    );

    return $query->fetchAll();
  }


  public function getPostById($id)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt,FK_User_Id,User_Name,User_Surname,User_Email FROM post INNER JOIN user ON FK_User_Id = User_Id WHERE Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }

  public function getCommentByPostId($id)
  {
    $sql = "SELECT Comment_Id,Comment_Article,Comment_CreateAt,FK_User_Id,FK_Post_Id,User_Name,User_Surname,User_Email FROM comment INNER JOIN user ON FK_User_Id = User_Id WHERE FK_Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetchAll();
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

  public function createComment($comment)
  {
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO comment (Comment_Article,FK_User_Id,FK_Post_Id) VALUES (:article,:userId,:postId)');
      $query->execute([
        'article' => $comment['article'],
        'userId' => $comment['userId'],
        'postId' => $comment['postId']
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }
}
