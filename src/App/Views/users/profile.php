<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>


<main class="">
  <div class="">
    <div>
      <img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
    </div>
    <div>
      <h1>Profil</h1>
      <p>Prénom : <?= $user['User_Surname'] ?></p>
      <p>Nom : <?= $user['User_Name'] ?></p>
      <p>Email : <?= $user['User_Email'] ?></p>
      <p>Nombre de Post publié : <?= count($post) ?></p>
      <div>
        <a href="../user/edit">Modifier</a>
        <a href="../user/delete">Supprimer</a>
      </div>
    </div>
  </div>
  <?php foreach ($post as $p) : ?>
    <div class="card w-3/5">
      <div class="card-header">
        <div class="card-user">
          <img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
          <h3><?php echo $p['User_Name'] . ' ' . $p['User_Surname']; ?></h3>
        </div>
        <h3><?php echo $p['Post_Title']; ?></h3>
        <p><?php echo $p['Post_CreateAt']; ?></p>
      </div>
      <div class="card-body">
        <p><?php echo $p['Post_Article']; ?></p>
      </div>
    </div>

  <?php endforeach; ?>
</main>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
