<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Bonnefete/dist/output.css">
  <link rel="stylesheet" href="/Bonnefete/src/public/css/style.css">
  <link rel="stylesheet" href="/Bonnefete/src/public/css/reaction.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>BONNEFETE</title>
</head>

<body>
  <nav class="navbar">
    <a class="navbar-brand" href="../user/login"><img class="icon-snow"
        src="/Bonnefete/src/public/assets/images/icons8-flocon-de-neige-64.png" alt="">BONNEFETE
    </a>

    <?php if (isset($_SESSION['user'])) : ?>
    <div class="nav-user">
      <a class="nav-user-profile" href="">Profil</a>
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