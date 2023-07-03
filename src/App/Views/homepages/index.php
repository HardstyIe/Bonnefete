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
          <div class="flex card-footer">
            <div class="flex card-footer-left">
              </form>


              <?php if (($_SESSION['user']['User_Id'] === $post['LikeUserId'] && $post['Post_Id'] === $post['LikePostId'])) { ?>

                <form action="../like/dislike/<?php echo $post['Post_Id']; ?>" method="post">
                  <input type="hidden" name="FK_Post_Id" value="<?php echo $post['Post_Id']; ?>">
                  <input type="hidden" name="FK_User_Id" value="<?php echo $_SESSION['user']['User_Id']; ?>">
                  <button type="submit" name="dislike" class="btn-like">
                    <img src="/Bonnefete/src/public/assets/icon/icons8-aimer-96.png" alt="">Unlike
                    <p><?php echo $post['LikeCount']; ?></p>
                  </button>
                </form>

              <?php } else { ?>

                <form action="../like/like/<?php echo $post['Post_Id']; ?>" method="post">
                  <input type="hidden" name="FK_Post_Id" value="<?php echo $post['Post_Id']; ?>">
                  <input type="hidden" name="FK_User_Id" value="<?php echo $_SESSION['user']['User_Id']; ?>">
                  <button type="submit" name="like" class="btn-like">
                    <img src="/Bonnefete/src/public/assets/icon/icons8-aimer-96.png" alt="">Like
                    <p><?php echo $post['LikeCount']; ?></p>
                  </button>
                </form>
              <?php } ?>

              <a href="../post/comment/<?php echo $post['Post_Id']; ?>">
                <img src="/Bonnefete/src/public/assets/icon/icons8-bulle-96.png" alt="">Comment
              </a>
            </div>
            <div class="flex card-footer-right">
              <?php if ($_SESSION['user']['User_Email'] == $post['User_Email'] || $_SESSION['user']['Role_Name'] == "Administrateur") :  ?>
                <a href="../post/update/<?php echo $post['Post_Id']; ?>">

                  <img src="/Bonnefete/src/public/assets/icon/icons8-modifier-96.png" alt="">Modifier
                </a>
                <a href="../post/delete/<?php echo $post['Post_Id']; ?>">
                  <img src="/Bonnefete/src/public/assets/icon/icons8-supprimer-96.png" alt="">supprimer
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>


      <?php endforeach; ?>
    </div>
  </div>

<?php endif; ?>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
