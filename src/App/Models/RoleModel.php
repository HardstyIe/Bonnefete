<?php

namespace Bonnefete\App\Models;

use Bonnefete\Bootstrap\Database;

class RoleModel
{
  private $connection;

  public function __construct()
  {
    $this->connection = new Database();
  }

  public function getAllRoles()
  {
    $query = $this->connection->getPdo()->prepare("SELECT Role_Id, Role_Name FROM role");
    $query->execute();
    $roles = $query->fetchAll();

    return $roles;
  }

  public function getRoleIdByName($roleName)
  {
    $query = $this->connection->getPdo()->prepare('SELECT Role_Id FROM role WHERE Role_Name = :roleName');
    $query->execute(['roleName' => $roleName]);
    $result = $query->fetch();
    if ($result) {
      return $result['Role_Id'];
    }

    return null;
  }
  public function getRoleNameById($roleId)
  {
    $query = $this->connection->getPdo()->prepare('SELECT Role_Name FROM role WHERE Role_Id = :roleId');
    $query->bindValue(':roleId', $roleId);
    $query->execute();
    $result = $query->fetch();

    if ($result) {
      return $result['Role_Name'];
    }

    return null;
  }



  public function getOneById($id)
  {
    $query = $this->connection->getPdo()->prepare("SELECT Role_Id,Role_Name FROM role WHERE Role_Id = :id");
    $query->execute([
      'id' => $id,
    ]);
    $role = $query->fetch();
    return $role;
  }

  public function getOneByName($name)
  {
    $query = $this->connection->getPdo()->prepare("SELECT Role_Id,Role_Name FROM role WHERE Role_Name = :name");
    $query->execute([
      'name' => $name,
    ]);
    $role = $query->fetch();
    return $role;
  }

  public function createRole($role)
  {
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO role (Role_Name) VALUES (:name)');
      $query->execute([
        'name' => $role['name'],
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function updateRole($role)
  {
    try {
      $query = $this->connection->getPdo()->prepare('UPDATE role SET Role_Name = :name WHERE Role_Id = :id');
      $query->execute([
        'name' => $role['name'],
        'id' => $role['id'],
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function deleteRole($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM role WHERE Role_Id = :id');
      $query->execute([
        'id' => $id,
      ]);
      return " Bien Enregistré ";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return " une erreur est survenue";
    }
  }

  public function getOneByEmail($email)
  {
    $query = $this->connection->getPdo()->prepare("SELECT User_Id,User_Email,User_Name,User_Surname,FK_Role_Id,Role_Name,User_Avatar FROM user INNER JOIN Role ON FK_Role_Id = Role_Id WHERE User_Email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetch();
    return $user;
  }
}
