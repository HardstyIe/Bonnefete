<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>



<?php if (isset($_SESSION['user'])) : ?>
  <div>
    <h1>Bienvenue sur BONNEFETE</h1>
    <a href="../post/create" class="btn">Publier un Post</a>

    <?php foreach ($posts as $post) : ?>
      <div class="card">
        <div class="card-header">
          <img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
          <div class="card-name">
            <h3><?php echo $post['User_Name'] . ' ' . $post['User_Surname']; ?></h3>
            <p><?php echo $post['Post_Date']; ?></p>
          </div>
        </div>
        <div class="card-body">
          <p><?php echo $post['Post_Content']; ?></p>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

<?php endif; ?>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
