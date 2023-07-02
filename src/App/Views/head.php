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

    <?php if (isset($_SESSION['user'])) : ?>
      <div class="nav-user">
        <?php if ($_SESSION['user']['Role_Name'] == "Administrateur") : ?>
          <a class="nav-user-list" href="/Bonnefete/user/userList">Liste des Utilisateurs</a>
        <?php endif; ?>

        <a class="nav-user-profile" href="/Bonnefete/user/MyProfile">Profil</a>
        <a class="nav-quit" href="../user/logout">Se déconnecter</a>
        <div class="nav-user-id"><a href="">
            <img class="nav-img-user" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt=""></a>
          <a class="nav-user-name">
            <?php echo $_SESSION['user']['User_Name'] . ' ' . $_SESSION['user']['User_Surname']; ?>
          </a>
        </div>
      </div>

    <?php else : ?>
    <?php endif; ?>

  </nav>
</body>
