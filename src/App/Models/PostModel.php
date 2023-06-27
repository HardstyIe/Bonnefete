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
    $date = new DateTime();
    $sql = "INSERT INTO post (Post_Title, Post_Article, Post_CreateAt) VALUES (:title,  :content, :date)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'title' => $post['title'],
      'content' => $post['content'],
      'date' => date("Y-m-d H:i:s")
    ]);
  }
}
