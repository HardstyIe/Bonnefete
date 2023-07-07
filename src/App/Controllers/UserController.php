<?php

namespace Bonnefete\App\Controllers;


require_once('./src/App/Models/UserModel.php');
require_once('./src/App/Models/PostModel.php');
require_once('./src/App/Models/HomeModel.php');
require_once('./src/App/Models/RoleModel.php');

use Bonnefete\App\Models\UserModel;
use Bonnefete\App\Models\PostModel;
use Bonnefete\App\Models\HomeModel;
use Bonnefete\App\Models\RoleModel;

class UserController
{
  protected $userModel;
  protected $postModel;
  protected $homeModel;

  protected $roleModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->postModel = new PostModel();
    $this->homeModel = new HomeModel();
    $this->roleModel = new RoleModel();
  }
  public function getRegister()
  {
    require_once '../Bonnefete/src/App/Views/users/register.php';
  }

  public function postRegister()
  {
    $user = $_POST;
    $message = $this->userModel->createUser($user);
    echo $message;
    echo '<a href="../user/login"> Se Connecter </a>';
  }

  public function getLogin()
  {
    require_once '../Bonnefete/src/App/Views/users/login.php';
  }

  public function postLogin()
  {
    $user = $_POST;
    $message = $this->userModel->loginUser($user);
    echo $message;
  }

  public function getLogout()
  {
    $this->userModel->logoutUser();
    header('Location: /bonnefete/user/login');
  }

  public function getMyProfile()
  {
    $user = $this->userModel->getOneByEmail($_SESSION['users']['email']);
    $post = $this->postModel->getAllUserPost($user);

    require_once '../Bonnefete/src/App/Views/users/profile.php';
  }

  // Dans votre contrôleur
  // Dans votre contrôleur
  public function getProfile($id)
  {
    $user = $this->userModel->getOneById($id);
    $roles = $this->roleModel->getAllRoles();
    $user['FK_role_id'] = $this->roleModel->getRoleIdByName($user['name']);;
    $post = $this->postModel->getAllUserPost($user);

    require_once '../Bonnefete/src/App/Views/users/profile.php';
  }

  public function postProfile()
  {
    // Récupérer les données de l'utilisateur depuis le formulaire
    $userData = [
      'id' => $_POST['id'],
      'email' => $_POST['email'],
      'nom' => $_POST['nom'],
      'prenom' => $_POST['prenom'],
      'password' => $_POST['password'],
      'role' => $this->roleModel->getRoleIdByName($_POST['role'])
    ];
    // Récupérer les données du fichier (avatar) depuis le formulaire
    $fileData = $_FILES;

    // Appeler la méthode updateUser du modèle en passant les données utilisateur et les données de fichier
    $message = $this->userModel->updateUser($userData, $fileData);

    echo $message;
    header('Location: /bonnefete/user/profile');
  }
  public function getUserList()
  {

    $users = $this->userModel->getUserListWithPostCount();
    require_once '../Bonnefete/src/App/Views/users/userList.php';
  }

  public function getPostByUser($id)
  {
    $user = $this->userModel->getOneById($id);
    $post = $this->postModel->getAllUserPost($user);
    require_once '../Bonnefete/src/App/Views/users/userList.php';
  }

  public function getUpdate($id)
  {
    $user = $this->userModel->getOneById($id);
    $roles = $this->roleModel->getAllRoles();
    require_once '../Bonnefete/src/App/Views/users/update.php';
  }

  public function postUpdate()
  {
    // Récupérer l'utilisateur à partir de la base de données
    $currentUser = $this->userModel->getOneById($_POST['id']);

    // Vérifier si l'utilisateur existe
    if (!$currentUser) {
      // Gérer le cas où l'utilisateur n'existe pas
      // Redirection ou affichage d'un message d'erreur, par exemple
      return;
    }

    // Récupérer le mot de passe actuel de l'utilisateur
    $currentPassword = $currentUser['password'];

    // Construire le tableau $user en incluant le mot de passe actuel
    $user = [
      'id' => $_POST['id'],
      'email' => $_POST['email'],
      'nom' => $_POST['nom'],
      'prenom' => $_POST['prenom'],
      'current_password' => $currentPassword, // Ajouter le mot de passe actuel
      'password' => $_POST['password'],
      'role' => $_POST['role']
    ];

    $message = $this->userModel->updateUser($user, $_FILES);

    echo $message;
    if ($_SESSION['users']['id'] == $_POST['id']) {
      header('Location: /bonnefete/user/MyProfile');
    } else {
      header('Location: /bonnefete/user/profile/' . $_POST['id']);
    }
  }




  public function getDeleteUser($id)
  {
    $user = $this->userModel->getOneById($id);
    require_once '../Bonnefete/src/App/Views/users/deleteUser.php';
  }

  public function postDeleteUser()
  {
    $user = $_POST;
    $message = $this->userModel->deleteUser($user);
    echo $message;
    header('Location: /bonnefete/user/userList');
  }
}
