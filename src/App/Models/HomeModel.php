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
    $sql = "SELECT Post_Title,Post_Article,Post_CreateAt FROM post";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  public function getPostById($id)
  {
    $sql = "SELECT Post_Title,Post_Article,Post_CreateAt FROM post WHERE Post_Id = :id";
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

  public function createPost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO post (Post_Title,Post_Article,Post_CreateAt,User_Id) VALUES (:title, :article, :date, :user)');
      $query->execute([
        'title' => $post['title'],
        'article' => $post['article'],
        'date' => $post['date'],
        'user' => $post['user'],
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function updatePost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE post SET Post_Title = :title, Post_Article = :article, Post_CreateAt = :date, User_Id = :user WHERE Post_Id = :id');
      $query->execute([
        'title' => $post['title'],
        'article' => $post['article'],
        'date' => $post['date'],
        'user' => $post['user'],
        'id' => $post['id'],
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
