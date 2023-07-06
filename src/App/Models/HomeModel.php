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
    COUNT(likes.FK_user_id) AS likes_count,
    posts.article,
    posts.title,
    posts.created_at,
    posts.id,
    posts.FK_user_id,
    users.email,
    users.name,
    users.surname,
    users.avatar,
    likes.FK_user_id AS likes_user_id,
    likes.FK_post_id AS likes_post_id,
    IF (IF (likes.FK_user_id=:userId, 1, 0)=IF (likes.FK_post_id=posts.id, 1, 0), 1, 0) AS is_liked,
    images.imagename
  FROM
    posts
  INNER JOIN users
    ON FK_user_id = users.id
  LEFT JOIN likes
    ON posts.id = likes.FK_post_id
  LEFT JOIN images
    ON posts.FK_image_id = images.id
  GROUP BY
    posts.id,
    likes_user_id,
    likes_post_id
  ORDER BY
    posts.created_at DESC;";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(
      [
        'userId' => $_SESSION['users']['id']
      ]
    );

    return $query->fetchAll();
  }


  public function getPostById($id)
  {
    $sql = "SELECT posts.id,posts.title,posts.article,posts.created_at,posts.FK_user_id,users.name,users.surname,users.email FROM posts INNER JOIN users ON FK_user_id = users.id WHERE posts.id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }

  public function getCommentByPostId($id)
  {
    $sql = "SELECT comments.id,comments.article,comments.created_at,comments.FK_user_id,comments.FK_post_id,users.name,users.surname,users.email FROM comments INNER JOIN users ON FK_user_id = users.id WHERE FK_post_id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetchAll();
  }

  public function getPostByUserId($id)
  {
    $sql = "SELECT posts.title,posts.article,posts.created_at FROM posts WHERE users.id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetchAll();
  }

  public function updatePost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE posts SET posts.title = :title, posts.article = :article WHERE posts.id = :id');
      $query->execute([
        'title' => $post['title'],
        'article' => $post['article'],
        'id' => $post['id']
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
      $query = $this->connection->getPdo()->prepare('DELETE FROM posts WHERE posts.id = :id');
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
      $query = $this->connection->getPdo()->prepare('INSERT INTO comments (comments.article,comments.FK_user_id,comments.FK_post_id) VALUES (:article,:userId,:postId)');
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
