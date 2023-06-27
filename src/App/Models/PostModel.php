<?php

namespace Bonnefete\App\Models;

use Bonnefete\Bootstrap\Database;

class PostModel
{

  private $connection;

  public function __construct()
  {
    $this->connection = new Database();
  }


  public function createPost($post)
  {
    $sql = "INSERT INTO post (Post_Title, Post_Article, Post_CreateAt) VALUES (:title,  :content, :date)";
    $query = $this->connection->getPDO()->prepare($sql);
    $query->execute([
      'title' => $post['title'],
      'author' => $post['author'],
      'content' => $post['content'],
      'date' => $post['date']
    ]);
  }
}
