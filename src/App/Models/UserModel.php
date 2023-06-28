<?php

namespace Bonnefete\App\Models;


use Bonnefete\Bootstrap\Database;



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
      $query = $this->connection->getPdo()->prepare('INSERT INTO user (User_Email, User_Surname, User_Name, User_Password) VALUES (:email, :prenom, :nom, :password)');
      $query->execute([
        'email' => $user['email'],
        'prenom' => $user['prenom'],
        'nom' => $user['nom'],
        'password' => $password,
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function getOneByEmail($email)
  {
    $query = $this->connection->getPdo()->prepare("SELECT User_Email,User_Name,User_Surname,User_Password,FK_Role_Id FROM user WHERE User_Email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetch();
    return $user;
  }
  public function loginUser($user)
  {
    $userFromDb = $this->getOneByEmail($user['email']);
    if ($userFromDb) {
      if (password_verify($user['password'], $userFromDb['User_Password'])) {
        $_SESSION['user'] = $userFromDb;
        header('Location: /bonnefete/user/register');
      } else {
        return "Mot de passe incorrect";
      }
    } else {
      return "Utilisateur inconnu";
    }
  }

  public function logoutUser()
  {
    session_destroy();
  }

  public function getAll()
  {
    $query = $this->connection->getPdo()->prepare("SELECT User_Email,User_Name,User_Surname,User_Password,FK_Role_Id FROM user");
    $query->execute();
    $users = $query->fetchAll();
    return $users;
  }
}
