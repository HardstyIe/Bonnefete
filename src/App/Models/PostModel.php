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

    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageName = $_FILES['image']['name'];
    $destination = realpath($_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesPost/') . '/' . $imageName;

    move_uploaded_file($_FILES['image']['tmp_name'], $destination);

    $sqlImage = "INSERT INTO images (Image_Name) VALUES (:imageName)";
    $queryImage = $this->connection->getPDO()->prepare($sqlImage);
    $queryImage->execute([
      'imageName' => $imageName
    ]);
    $imageId = $this->connection->getPDO()->lastInsertId();

    $sql = "INSERT INTO post (Post_Title, Post_Article, Post_CreateAt, FK_User_Id, FK_Image_Id) VALUES (:title,  :content , :date , :user, :imageId)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'title' => $post['title'],
      'content' => $post['content'],
      'date' => date("Y-m-d H:i:s"),
      'user' => $users['User_Id'],
      'imageId' => $imageId
    ]);
  }


  public function getAllUserPost($user)
  {
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt,FK_User_Id,User_Name,User_Surname,User_Email,User_Avatar FROM post INNER JOIN user ON FK_User_Id = User_Id WHERE User_Email = :user";
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
    $sql = "SELECT Post_Id,Post_Title,Post_Article,Post_CreateAt,FK_User_Id,Post_Like,Post_Comment,User_Name,User_Surname,User_Email,User_Avatar FROM post INNER JOIN user ON FK_User_Id = User_Id WHERE Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }


  public function updatePost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE post SET Post_Title = :title, Post_Article = :article WHERE Post_Id = :id');
      var_dump($post);
      $query->execute([
        'title' => $post['title'],
        'article' => $post['article'],
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function createComment($comment)
  {
    $sqlUser = "SELECT User_Id FROM user WHERE User_Email = :user";
    $queryUser = $this->connection->getPDO()->prepare($sqlUser);
    $queryUser->execute([
      'user' => $_SESSION['user']["User_Email"]
    ]);
    $users = $queryUser->fetch();
    $sql = "INSERT INTO comment(Comment_Article, Comment_CreateAt, FK_User_Id, FK_Post_Id) VALUES (:article , :date , :user, :post)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'article' => $comment['article'],
      'date' => date("Y-m-d H:i:s"),
      'user' => $users['User_Id'],
      'post' => $comment['FK_Post_Id']
    ]);
  }


  public function getAllComment($id)
  {
    $sql = "SELECT Comment_Id,Comment_Content,Comment_CreateAt,FK_User_Id,FK_Post_Id,User_Name,User_Surname,User_Email,User_Avatar FROM comment INNER JOIN user ON FK_User_Id = User_Id WHERE FK_Post_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'id' => $id
    ]);
    return $query->fetchAll();
  }


  public function getCommentById($id)
  {
    $sql = "SELECT Comment_Id,Comment_Content,Comment_CreateAt,FK_User_Id,FK_Post_Id,User_Name,User_Surname,User_Email,User_Avatar FROM comment INNER JOIN user ON FK_User_Id = User_Id WHERE Comment_Id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }

  public function deleteComment($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM comment WHERE Comment_Id = :id');
      $query->execute([
        'id' => $id
      ]);
      return " Bien Supprimé ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function updateComment($comment)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE comment SET Comment_Content = :content WHERE Comment_Id = :id');
      var_dump($comment);
      $query->execute([
        'content' => $comment['content'],
        'id' => $comment['id']
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }
}
