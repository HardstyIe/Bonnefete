<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<?php include_once('./src/utils/avatar_image.php'); ?>

<main class="m-profile">
  <div class="">
<<<<<<< HEAD
    <div class="profile-avatar" >
      <?php if (isset($user['User_Avatar'])) : ?>
        <img class="card-img h-10" src="<?= $avatarPath . $user['User_Avatar'] ?>" alt="">
=======
    <div>
      <?php if (isset($user['avatar'])) : ?>
        <img class="card-img h-10" src="<?= $avatarPath . $user['avatar'] ?>" alt="">
>>>>>>> e6cb7532fdae164247caa91a06c84379d40702bb
      <?php else : ?>
        <img class="card-img h-10" src="<?= $defaultAvatarPath ?>" alt="">
      <?php endif; ?>
    </div>
<<<<<<< HEAD
    <div class="profile">
      <h1>Profile</h1>
      <p>Prénom : <?= $user['User_Surname'] ?></p>
      <p>Nom : <?= $user['User_Name'] ?></p>
      <p>Email : <?= $user['User_Email'] ?></p>
      <p>Nombre de Post publiès : <?= count($post) ?></p>
      <?php if ($_SESSION['user']['User_Email'] == $user['User_Email'] || $_SESSION['user']['FK_Role_Id'] == 1 || $_SESSION['user']['FK_Role_Id'] == 2) : ?>
        <div>
          <a class="btn-profile-edit" href="/Bonnefete/user/update/<?php echo $user['User_Id']; ?>">Modifier</a>
          <a class="btn-profile-delete" href="/Bonnefete/user/delete/<?php echo $user['User_Id']; ?>">Supprimer</a>
=======
    <div>
      <h1>Profil</h1>
      <p>Prénom : <?= $user['surname'] ?></p>
      <p>Nom : <?= $user['name'] ?></p>
      <p>Email : <?= $user['email'] ?></p>
      <p>Nombre de Post publié : <?= count($post) ?></p>
      <?php if ($_SESSION['users']['email'] == $user['email'] || $_SESSION['users']['FK_role_id'] == 1 || $_SESSION['users']['FK_role_id'] == 2) : ?>
        <div>
          <a href="/Bonnefete/user/update/<?php echo $user['id']; ?>">Modifier</a>
          <a href="/Bonnefete/user/delete/<?php echo $user['id']; ?>">Supprimer</a>
>>>>>>> e6cb7532fdae164247caa91a06c84379d40702bb
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php foreach ($post as $p) : ?>
    <div class="card w-3/5">
      <div class="card-header">
        <div class="card-user">
          <img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
          <h3><?php echo $p['name'] . ' ' . $p['surname']; ?></h3>
        </div>
        <h3><?php echo $p['title']; ?></h3>
        <p><?php echo $p['created_at']; ?></p>
      </div>
      <div class="card-body">
        <p><?php echo $p['article']; ?></p>
      </div>
    </div>

  <?php endforeach; ?>
</main>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
