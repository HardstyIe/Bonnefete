<?php

namespace App\Models;

use App\Database;

class UserModel
{
  private $connection;

  public function __construct()
  {
    $this->connection = new Database();
  }

  public function createUser($user)
  {

    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO user (email, prenom, nom, password) VALUES (:email, :prenom, :nom, :password)');
      $query->execute([
        'email' => $user['email'],
        'prenom' => $user['prenom'],
        'nom' => $user['nom'],
        'password' => $password,
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      return " une erreur est survenue";
    }
  }

  public function getOneByEmail($email)
  {
    $query = $this->connection->getPdo()->prepare("SELECT * FROM user WHERE email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetchObject();
    return $user;
  }
}
