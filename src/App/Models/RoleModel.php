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
    $query = $this->connection->getPdo()->prepare("SELECT roles.id, roles.rolename FROM roles");
    $query->execute();
    $roles = $query->fetchAll();

    return $roles;
  }

  public function getRoleIdByName($roleName)
  {
    $query = $this->connection->getPdo()->prepare('SELECT roles.id FROM roles WHERE roles.rolename = :roleName');
    $query->execute(['roleName' => $roleName]);
    $result = $query->fetch();
    if ($result) {
      return $result['id'];
    }

    return null;
  }
  public function getRoleNameById($roleId)
  {
    $query = $this->connection->getPdo()->prepare('SELECT roles.rolename FROM roles WHERE roles.id = :roleId');
    $query->bindValue(':roleId', $roleId);
    $query->execute();
    $result = $query->fetch();

    if ($result) {
      return $result['name'];
    }

    return null;
  }



  public function getOneById($id)
  {
    $query = $this->connection->getPdo()->prepare("SELECT roles.id,roles.rolename FROM roles WHERE roles.id = :id");
    $query->execute([
      'id' => $id,
    ]);
    $role = $query->fetch();
    return $role;
  }

  public function getOneByName($name)
  {
    $query = $this->connection->getPdo()->prepare("SELECT roles.id,roles.rolename FROM roles WHERE roles.rolename = :name");
    $query->execute([
      'name' => $name,
    ]);
    $role = $query->fetch();
    return $role;
  }

  public function createRole($role)
  {
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO roles (roles.rolename) VALUES (:name)');
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
      $query = $this->connection->getPdo()->prepare('UPDATE roles SET roles.rolename = :name WHERE id = :id');
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
      $query = $this->connection->getPdo()->prepare('DELETE FROM roles WHERE roles.id = :id');
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
    $query = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.FK_role_id,roles.rolename,users.avatar FROM users INNER JOIN roles ON FK_role_id = roles.id WHERE users.email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetch();
    return $user;
  }
}
