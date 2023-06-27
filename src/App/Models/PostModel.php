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
    $sql = "INSERT INTO post (Post_Title, Post_Article, Post_CreateAt, User_Id) VALUES (:title,  :content , :date , :user)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'title' => $post['title'],
      'content' => $post['content'],
      'date' => date("Y-m-d H:i:s"),
      'user' => $users[0]
    ]);
  }
}
