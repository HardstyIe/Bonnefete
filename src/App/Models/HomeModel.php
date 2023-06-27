<?php

namespace Bonnefete\App\Models;


use Bonnefete\Bootstrap\Database;


class HomeModel{
  private $connection;
  public function __construct()
  {
    $this->connection = new Database();
  }

  //  fait moi un HomeModel qui recupere les donnée de la table post pour les afficher sur la page home

  public function getAllPost()
  {
    $query = $this->connection->getPdo()->prepare("SELECT * FROM post");
    $query->execute();
    $post = $query->fetchAll();
    return $post;
  }

  public function getOnePost($id)
  {
    $query = $this->connection->getPdo()->prepare("SELECT * FROM post WHERE Post_Id = :id");
    $query->execute([
      'id' => $id,
    ]);
    $post = $query->fetch();
    return $post;
  }

}
