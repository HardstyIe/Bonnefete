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
    $query = $this->connection->getPdo()->prepare("SELECT User_Email,User_Name,User_Surname,FK_Role_Id,Role_Name FROM user INNER JOIN Role ON FK_Role_Id = Role_Id WHERE User_Email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetch();
    return $user;
  }
  public function loginUser($user)
  {
    $userFromDb = $this->connection->getPdo()->prepare("SELECT User_Id,User_Email,User_Name,User_Surname,User_Password,FK_Role_Id,Role_Name FROM user INNER JOIN role ON FK_Role_Id = Role_Id WHERE User_Email = :email");
    $userFromDb->execute(['email' => $user['email']]);
    $userFromDb = $userFromDb->fetch();
    if ($userFromDb) {
      if (password_verify($user['password'], $userFromDb['User_Password'])) {
        $_SESSION['user'] = $userFromDb;
        header('Location: /bonnefete/home/index');
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
    $query = $this->connection->getPdo()->prepare("SELECT User_Id,User_Email,User_Name,User_Surname,User_Password,FK_Role_Id,Role_Name FROM user INNER JOIN role ON FK_Role_Id = Role_Id");
    $query->execute();
    $users = $query->fetchAll();
    return $users;
  }

  public function getUserListWithPostCount()
  {
    $query = $this->connection->getPdo()->prepare("SELECT User_Id,User_Email,User_Name,User_Surname,User_Password,FK_Role_Id,count(Post_Id) as Nb_Post FROM user LEFT JOIN post ON FK_User_Id = User_Id GROUP BY User_Email");
    $query->execute();
    $users = $query->fetchAll();
    return $users;
  }

  public function getOneById($id)
  {
    $query = $this->connection->getPdo()->prepare("SELECT User_Email,User_Name,User_Surname,User_Password,FK_Role_Id,Role_Name FROM user INNER JOIN role ON FK_Role_Id = Role_Id WHERE User_Id = :id");
    $query->execute([
      'id' => $id,
    ]);
    $user = $query->fetch();
    return $user;
  }

  public function updateUser($user)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE user SET User_Email = :email, User_Name = :nom, User_Surname = :prenom, User_Password = :password, FK_Role_Id = :role WHERE User_Id = :id');
      $query->execute([
        'email' => $user['email'],
        'nom' => $user['nom'],
        'prenom' => $user['prenom'],
        'password' => $user['password'],
        'role' => $user['role'],
        'id' => $user['id'],
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function deleteUser($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM user WHERE User_Id = :id');
      $query->execute([
        'id' => $id,
      ]);
      return " Bien Supprimé ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }
}
