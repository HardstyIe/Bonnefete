<?php

namespace Bonnefete\App\Models;

require_once('./src/App/Models/RoleModel.php');
include_once('./src/utils/console_log.php');

use Bonnefete\Bootstrap\Database;
use Bonnefete\App\Models\RoleModel;

class UserModel
{
  private $connection;

  protected $roleModel;

  public function __construct()
  {
    $this->connection = new Database();
    $this->roleModel = new RoleModel();
  }

  public function createUser($user)
  {
    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    try {
      $query = $this->connection->getPdo()->prepare('INSERT INTO users (users.email, users.surname, users.name, users.password) VALUES (:email, :prenom, :nom, :password)');
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
    $query = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.FK_role_id,roles.rolename,users.avatar FROM users INNER JOIN roles ON FK_role_id = roles.id WHERE users.email = :email");
    $query->execute([
      'email' => $email,
    ]);
    $user = $query->fetch();
    return $user;
  }
  public function loginUser($user)
  {
    $userFromDb = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.password,users.FK_role_id,roles.rolename,users.avatar FROM users INNER JOIN roles ON users.FK_role_id = roles.id WHERE users.email = :email");
    $userFromDb->execute(['email' => $user['email']]);
    $userFromDb = $userFromDb->fetch();
    if ($userFromDb) {
      if (password_verify($user['password'], $userFromDb['password'])) {
        $_SESSION['users'] = $userFromDb;
        header('Location: /bonnefete/home/index');
        exit;
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
    $query = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.password,users.FK_role_id,roles.rolename FROM users INNER JOIN roles ON users.FK_role_id = roles.id");
    $query->execute();
    $users = $query->fetchAll();
    return $users;
  }

  public function getUserListWithPostCount()
  {
    $query = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.password,users.FK_role_id,count(posts.id) as nb_posts FROM users LEFT JOIN posts ON FK_user_id = users.id GROUP BY users.email");
    $query->execute();
    $users = $query->fetchAll();
    return $users;
  }

  public function getOneById($id)
  {
    $query = $this->connection->getPdo()->prepare("SELECT users.id,users.email,users.name,users.surname,users.password,users.FK_role_id,roles.rolename,users.avatar FROM users INNER JOIN roles ON users.FK_role_id = roles.id WHERE users.id = :id");
    $query->execute([
      'id' => $id,
    ]);
    $user = $query->fetch();
    return $user;
  }

  public function updateUser($userData, $fileData)
  {
    try {
      // Vérifier si un fichier d'image est téléchargé
      if (isset($fileData['avatar']) && $fileData['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarData = file_get_contents($fileData['avatar']['tmp_name']);
        $avatarName = $fileData['avatar']['name'];
        $avatarDestination = $_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesAvatar/' . $avatarName;
        move_uploaded_file($fileData['avatar']['tmp_name'], $avatarDestination);

        // Supprimer l'ancien avatar s'il existe
        if (!empty($userData['old_avatar'])) {
          $oldAvatarPath = $_SERVER['DOCUMENT_ROOT'] . '/Bonnefete/src/public/assets/imagesAvatar/' . $userData['old_avatar'];
          if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
          }
        }

        // Enregistrement du nouvel avatar dans la base de données
        $query = $this->connection->getPdo()->prepare('UPDATE users SET avatar = :avatarName WHERE users.id = :id');
        $query->bindValue(':avatarName', $avatarName);
        $query->bindValue(':id', $userData['id']);
        $query->execute();
      }

      // Mettre à jour les autres informations de l'utilisateur
      if (empty($userData['password'])) {
        $password = $userData['current_password'];
      } else {
        $password = password_hash($userData['password'], PASSWORD_DEFAULT);
      }

      switch ($_SESSION['users']['FK_role_id']) {
        case 1:
          $newRoleId = $userData['role'];
          break;
        case 2:
          if ($userData['role'] > 1) {
            $newRoleId = $userData['role'];
          }
      }

      $query = $this->connection->getPdo()->prepare('UPDATE users SET users.email = :email, users.name = :nom, users.surname = :prenom, users.password = :password, users.FK_role_id = :role WHERE users.id = :id');
      $query->execute([
        'email' => $userData['email'],
        'nom' => $userData['nom'],
        'prenom' => $userData['prenom'],
        'password' => $password,
        'role' => $_POST['role'],
        'id' => $userData['id'],
      ]);

      return "Bien Enregistré";
    } catch (\PDOException $e) {
      var_dump($e->getMessage());
      return "Une erreur est survenue";
    }
  }
  public function deleteUser($id)
  {
    try {
      $query = $this->connection->getPdo()->prepare('DELETE FROM users WHERE users.id = :id');
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
