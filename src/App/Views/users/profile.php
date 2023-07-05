<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<?php include_once('./src/utils/avatar_image.php'); ?>

<main class="">
  <div class="">
    <div>
      <?php if (isset($user['User_Avatar'])) : ?>
        <img class="card-img h-10" src="<?= $avatarPath . $user['User_Avatar'] ?>" alt="">
      <?php else : ?>
        <img class="card-img h-10" src="<?= $defaultAvatarPath ?>" alt="">
      <?php endif; ?>
    </div>
    <div>
      <h1>Profil</h1>
      <p>Prénom : <?= $user['User_Surname'] ?></p>
      <p>Nom : <?= $user['User_Name'] ?></p>
      <p>Email : <?= $user['User_Email'] ?></p>
      <p>Nombre de Post publié : <?= count($post) ?></p>
      <?php if ($_SESSION['user']['User_Email'] == $user['User_Email'] || $_SESSION['user']['FK_Role_Id'] == 1 || $_SESSION['user']['FK_Role_Id'] == 2) : ?>
        <div>
          <a href="/Bonnefete/user/update/<?php echo $user['User_Id']; ?>">Modifier</a>
          <a href="/Bonnefete/user/delete/<?php echo $user['User_Id']; ?>">Supprimer</a>
        </div>
      <?php endif; ?>
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
