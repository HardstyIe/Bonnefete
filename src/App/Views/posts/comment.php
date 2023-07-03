<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<?php if (isset($_SESSION['user'])) :  ?>
  <div class="container">
    <div class="w-full h-full home-page">
      <a class="btn-post" href="../post/create">
        <img src="/Bonnefete/src/public/assets/icon/icons8-new-post-96.png" alt="">
      </a>
      <?php foreach ($posts as $post) :  ?>
        <div class="w-3/5 card">
          <div class="card-header">
            <div class="card-user">
              <img class="card-img" src="/Bonnefete/src/public/assets/images/photo-avatar-profil.png" alt="">
              <h3><?php echo $post['User_Name'] . ' ' . $post['User_Surname']; ?></h3>
            </div>
            <h3><?php echo $post['Post_Title']; ?></h3>
            <p><?php echo $post['Post_CreateAt']; ?></p>
          </div>
          <div class="card-body">
            <p><?php echo $post['Post_Article']; ?></p>
          </div>

        </div>


      <?php endforeach; ?>
    </div>
  </div>

<?php endif; ?>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
