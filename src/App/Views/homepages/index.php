<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>



<?php if (isset($_SESSION['user'])) : ?>
  <div>
    <h1>Bienvenue sur BONNEFETE</h1>
    <a href="../post/create" class="btn">Publier un Post</a>

    <?php foreach ($posts as $post) : ?>
      <div class="card">
        <div class="card-header">
          <div><img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">


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
      <?php endforeach; ?>

      </div>

    <?php endif; ?>

    <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
