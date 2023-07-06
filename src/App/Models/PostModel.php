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
    try {
      $sqlUser = "SELECT users.id FROM users WHERE users.email = :user";
      $queryUser = $this->connection->getPDO()->prepare($sqlUser);
      $queryUser->execute([
        'user' => $_SESSION['users']["email"]
      ]);
      $users = $queryUser->fetch();
      $date = new DateTime();

      if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $imageName = $_FILES['image']['name'];
        $destination = realpath($_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesPost/') . '/' . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        $sqlImage = "INSERT INTO images (images.imagename) VALUES (:imageName)";
        $queryImage = $this->connection->getPDO()->prepare($sqlImage);
        $queryImage->execute([
          'imageName' => $imageName
        ]);
        $imageId = $this->connection->getPDO()->lastInsertId();
        var_dump($imageId);
      } else {
        // Si aucune image n'est insérée, vous pouvez attribuer une valeur par défaut à $imageId
        $imageId = null;
      }

      $sql = "INSERT INTO posts (posts.title, posts.article, posts.created_at, posts.FK_user_id, posts.FK_image_id) VALUES (:title,  :content , :date , :user, :imageId)";
      $query = $this->connection->getPDO()->prepare($sql);
      $query->execute([
        'title' => $post['title'],
        'content' => $post['content'],
        'date' => date("Y-m-d H:i:s"),
        'user' => $users['id'],
        'imageId' => $imageId
      ]);
      //code...
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return "Une erreur est survenue";
    }
  }



  public function getAllUserPost($user)
  {
    $sql = "SELECT posts.id,posts.title,posts.article,posts.created_at,posts.FK_user_id,users.name,users.surname,users.email,users.avatar FROM posts INNER JOIN users ON FK_user_id = users.id WHERE users.email = :user";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'user' => $user['email']
    ]);
    return $query->fetchAll();
  }

  public function getPostById($id)
  {
    $sql = "SELECT posts.id, posts.title, posts.article, posts.FK_image_id, posts.created_at FROM posts WHERE posts.id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetchAll();
  }




  public function deletePost($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM posts WHERE posts.id = :id');
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
    $sql = "SELECT posts.id,posts.title,posts.article,posts.created_at,posts.FK_user_id,users.name,users.surname,users.email,users.avatar FROM posts INNER JOIN users ON FK_user_id = users.id WHERE posts.id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }


  public function updatePost($post)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE posts SET posts.article = :article WHERE posts.id = :id');

      if (!empty($post['title'])) {
        $query = $this->connection->getPdo()->prepare('UPDATE posts SET posts.title = :title, posts.article = :article WHERE posts.id = :id');
        $query->bindValue(':title', $post['title']);
      }

      $query->bindValue(':article', $post['article']);
      $query->bindValue(':id', $post['id']);
      $query->execute();

      // Vérifier si une nouvelle image a été téléchargée
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Supprimer l'ancienne image si elle existe
        if (!empty($post['FK_image_id'])) {
          $oldImageId = $post['FK_image_id'];
          $oldImagePath = realpath($_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesPost/') . '/' . $oldImageId;
          if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
          }
        }

        // Télécharger et enregistrer la nouvelle image
        $newImageName = $_FILES['image']['name'];
        $destination = realpath($_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesPost/') . '/' . $newImageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        // Insérer la nouvelle image dans la table des images et récupérer son identifiant
        $query = $this->connection->getPdo()->prepare('INSERT INTO images (images.imagename) VALUES (:imageName)');
        $query->bindValue(':imageName', $newImageName);
        $query->execute();
        $newImageId = $this->connection->getPdo()->lastInsertId();

        // Mettre à jour l'identifiant de l'image dans la table des posts
        $query = $this->connection->getPdo()->prepare('UPDATE posts SET FK_image_id = :imageId WHERE posts.id = :id');
        $query->bindValue(':imageId', $newImageId);
        $query->bindValue(':id', $post['id']);
        $query->execute();
      }

      return "Bien Enregistré";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return "Une erreur est survenue";
    }
  }






  public function createComment($comment)
  {
    try {
      $sqlUser = "SELECT users.id FROM users WHERE users.email = :user";
      $queryUser = $this->connection->getPDO()->prepare($sqlUser);
      $queryUser->execute([
        'user' => $_SESSION['users']["email"]
      ]);
      $users = $queryUser->fetch();
      $sql = "INSERT INTO comments(comments.article, comments.created_at, comments.FK_user_id, comments.FK_post_id) VALUES (:content , :date , :user, :post)";
      $query = $this->connection->getPDO()->prepare($sql);
      $query->execute([
        'content' => $comment['content'],
        'date' => date("Y-m-d H:i:s"),
        'user' => $users['id'],
        'post' => $comment['FK_post_id']
      ]);
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }


  public function getAllComment($id)
  {
    $sql = "SELECT comments.id,comments.article,comments.created_at,comments.FK_user_id,comments.FK_post_id,users.name,users.surname,users.email,users.avatar FROM comments INNER JOIN users ON FK_user_id = users.id WHERE FK_post_id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute([
      'id' => $id
    ]);
    return $query->fetchAll();
  }


  public function getCommentById($id)
  {
    $sql = "SELECT comments.id,comments.content,comments.created_at,comments.FK_user_id,comments.FK_post_id,users.name,users.surname,users.email,users.avatar FROM comments INNER JOIN users ON FK_user_id = users.id WHERE comments.id = :id";
    $query = $this->connection->getPdo()->prepare($sql);
    $query->execute(['id' => $id]);
    return $query->fetch();
  }

  public function deleteComment($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM comments WHERE comments.id = :id');
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
      $query = $this->connection->getPdo()->prepare('UPDATE comments SET comments.article = :content WHERE comments.id = :id');
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
