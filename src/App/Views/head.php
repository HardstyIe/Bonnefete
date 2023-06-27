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
    <a class="navbar-brand" href="../char/index">BONNEFETE</a>

    <?php if (isset($_SESSION['user'])) : ?>
      <div class="nav-user">
        <a class="nav-user-profile">Profil</a>
        <a class="nav-quit" href="../user/logout">Se déconnecter</a>
        <div class="nav-user-id"><a href="">
            <img class="nav-img-user" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt=""></a>
          <a class="nav-user-name">Utilisateur</a>
        </div>
      </div>

    <?php else : ?>
      <a class="nav-item nav-link" href="../user/login">Se connecter</a>
      <a class="nav-item nav-link" href="../user/register">S'enregistrer</a>


    <?php endif; ?>

  </nav>
</body>
