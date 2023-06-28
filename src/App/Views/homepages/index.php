<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>



<?php if (isset($_SESSION['user'])) : ?>
<div class="home-page">
  <a class="btn-post w-full h-full" href="../post/create"><img
      src="/Bonnefete/src/public/assets/icon/icons8-new-post-96.png" alt=""></a>

  <?php foreach ($posts as $post) : ?>
  <div class="card">
    <div class="card-header">
      <div><img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
        <h3><?php echo $post['User_Name'] . ' ' . $post['User_Surname']; ?></h3>
      </div>
      <div class="card-name">
        <h3>
          <?php echo $post['Post_Title']; ?>
        </h3>
        <p>
          <?php echo $post['Post_CreateAt']; ?>
        </p>

      </div>
      <div class="card-body">
        <p><?php echo $post['Post_Article']; ?></p>
      </div>
    </div>
    <div>
      <a class="btn-like" href=""><img src="/Bonnefete/src/public/assets/icon/icons8-coeur-96.png" alt="">Likez</a>
      <a class="btn-comment" href=""><img src="/Bonnefete/src/public/assets/icon/icons8-commentaires-96.png"
          alt="">Commentez</a>

    </div>
    <?php endforeach; ?>

  </div>

  <?php endif; ?>

  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>