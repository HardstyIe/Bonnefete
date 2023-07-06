<?php include_once('./src/utils/avatar_image.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Bonnefete/dist/output.css">
  <link rel="stylesheet" href="/Bonnefete/src/public/css/style.css">
  <title>BONNEFETE</title>
</head>

<body>
  <nav class="navbar">
    <a class="navbar-brand" href="/Bonnefete/home/index"><img class="icon-snow" src="/Bonnefete/src/public/assets/images/icons8-flocon-de-neige-64.png" alt="">BONNEFETE
    </a>

    <?php if (isset($_SESSION['users'])) :  ?>
      <div class="nav-user">
        <?php if ($_SESSION['users']['rolename'] == "Administrateur" || $_SESSION['users']['rolename'] == "SuperAdministrateur") : ?>
          <a class="nav-user-list" href="/Bonnefete/user/userList">Liste des Utilisateurs</a>
          <?php if ($_SESSION['users']['rolename'] == "SuperAdministrateur") : ?>
            <a class="nav-user-list" href="/Bonnefete/user/log">Liste des Logs</a>
          <?php endif; ?>
        <?php endif; ?>

        <a class="nav-user-profile" href="/Bonnefete/user/MyProfile">Profil</a>
        <a class="nav-quit" href="../user/logout">Se déconnecter</a>
        <div class="nav-user-id">
          <a href="/Bonnefete/user/MyProfile">
            <?php if (!empty($_SESSION['users']['avatar'])) : ?>
              <img class="h-10 card-img" src="<?= $avatarPath . $_SESSION['users']['avatar'] ?>" alt="">
            <?php else : ?>
              <img class="h-10 card-img" src="<?= $defaultAvatarPath ?>" alt="">
            <?php endif; ?>
          </a>
          <a class="nav-user-name">
            <?php echo $_SESSION['users']['name'] . ' ' . $_SESSION['users']['surname']; ?>
          </a>
        </div>
      </div>

    <?php else : ?>
    <?php endif; ?>

  </nav>
</body>
