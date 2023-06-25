<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/php-crud/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../char/index">CRUD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse show" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="../char/index">Home</a>
        <?php if (isset($_SESSION['user'])) : ?>
          <a class="nav-item nav-link" href="../user/logout">Se deconnecter</a>
          <a class="nav-item nav-link" href="../char/create">Ajoutez un personnage</a>

        <?php else : ?>
          <a class="nav-item nav-link" href="../user/login">Se connecter</a>
          <a class="nav-item nav-link" href="../user/register">S'enregistrer</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
