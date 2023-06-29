<?php

namespace Bonnefete\App\Models;

use Bonnefete\Bootstrap\Database;
use DateTime;

class PostModel
{

  private $connection;

  public function __construct()
  {
    $this->connection = new Database();
  }


  public function createPost($post)
  {
    $sqlUser = "SELECT User_Id FROM user WHERE User_Email = :user";
    $queryUser = $this->connection->getPDO()->prepare($sqlUser);
    $queryUser->execute([
      'user' => $_SESSION['user']["User_Email"]
    ]);
    $users = $queryUser->fetch();
    $date = new DateTime();
    $sql = "INSERT INTO post (Post_Title, Post_Article, Post_CreateAt, FK_User_Id) VALUES (:title,  :content , :date , :user)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'title' => $post['title'],
      'content' => $post['content'],
      'date' => date("Y-m-d H:i:s"),
      'user' => $users['User_Id']
    ]);
  }

  public function getAllUserPost($user)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt,FK_User_Id,Post_Like,Post_Comment,User_Name,User_Surname,User_Email FROM post INNER JOIN user ON FK_User_Id = User_Id WHERE User_Email = :user";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'user' => $user['User_Email']
    ]);
    return $query->fetchAll();
  }

  public function getPostById($id)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt FROM post WHERE Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }



  public function deletePost($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM post WHERE Post_Id = :id');
      $query->execute([
        'id' => $id
      ]);
      return " Bien Supprimé ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }
  public function getOneById($id)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt,FK_User_Id,Post_Like,Post_Comment,User_Name,User_Surname,User_Email FROM post INNER JOIN user ON FK_User_Id = User_Id WHERE Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
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
}
