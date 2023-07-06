<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<?php include_once('./src/utils/avatar_image.php'); ?>

<?php if (isset($_SESSION['users'])) : ?>
  <div class="container">
    <div class="w-full h-full home-page">
      <a class="btn-post" href="../post/create">
        <img src="/Bonnefete/src/public/assets/icon/icons8-new-post-96.png" alt="">
      </a>
      <?php foreach ($posts as $post) : ?>
        <div class="w-3/5 card">
          <div class="card-header">
            <div class="card-user">
              <?php if (isset($post['avatar'])) : ?>
                <img class="h-10 card-img" src="<?= $avatarPath . $post['avatar'] ?>" alt="">
              <?php else : ?>
                <img class="h-10 card-img" src="<?= $defaultAvatarPath ?>" alt="">
              <?php endif; ?>
              <h3><?php echo $post['name'] . ' ' . $post['surname']; ?></h3>
            </div>
            <h3><?php echo $post['title']; ?></h3>
            <p><?php echo $post['created_at']; ?></p>
          </div>
          <div class="card-body">
            <p><?php echo $post['article']; ?>
              <?php if (!empty($post['imagename'])) : ?>
                <img src="/Bonnefete/src/public/assets/imagesPost/<?= $post['imagename'] ?>" alt="Image du post">
              <?php endif; ?>
            </p>

          </div>
          <div class="card-footer">
            <div class="post-like">
              </form>
              <?php if (($_SESSION['users']['id'] === $post['likes_user_id'] && $post['id'] === $post['likes_post_id'])) { ?>

                <form action="../like/dislike/<?php echo $post['id']; ?>" method="post">
                  <input type="hidden" name="FK_post_id" value="<?php echo $post['id']; ?>">
                  <input type="hidden" name="FK_user_id" value="<?php echo $_SESSION['users']['id']; ?>">
                  <button type="submit" name="dislike" class="btn-like">
                    <img src="/Bonnefete/src/public/assets/icon/icons8-aimer-96.png" alt="">Unlike
                    <p><?php echo $post['likes_count']; ?></p>
                  </button>
                </form>

              <?php } else { ?>

                <form action="../like/like/<?php echo $post['id']; ?>" method="post">
                  <input type="hidden" name="FK_post_id" value="<?php echo $post['id']; ?>">
                  <div class="like-post">
                    <input type="hidden" name="FK_user_id" value="<?php echo $_SESSION['users']['id']; ?>">
                    <button type="submit" name="like" class="btn-like">
                      <img src="/Bonnefete/src/public/assets/icon/icons8-aimer-96.png" alt="">Like
                      <p><?php echo $post['likes_count']; ?></p>
                    </button>
                  </div>
                </form>
              <?php } ?>
            </div>

            <div class="comment-post">
              <img src="/Bonnefete/src/public/assets/icon/icons8-bulle-96.png" alt="">
              <a href="../post/comment/<?php echo $post['id']; ?>">Comment</a>
            </div>

            <?php if ($_SESSION['users']['rolename'] == "SuperAdministrateur" || $_SESSION['users']['email'] == $post['email']) : ?>
              <div class="edit-img">
                <img src="/Bonnefete/src/public/assets/icon/icons8-modifier-96.png" alt="">
                <a href="../post/update/<?php echo $post['id']; ?>">Modifier</a>
              </div>

              <div class="delete-post">
                <img src="/Bonnefete/src/public/assets/icon/icons8-supprimer-96.png" alt="">
                <a href="../post/delete/<?php echo $post['id']; ?>">Supprimer</a>
              </div>
            <?php elseif ($_SESSION['users']['rolename'] == "Administrateur") : ?>
              <div class="edit-img">
                <img src="/Bonnefete/src/public/assets/icon/icons8-modifier-96.png" alt="">
                <a href="../post/update/<?php echo $post['id']; ?>">Modifier</a>
              </div>
            <?php endif; ?>



          </div>
        </div>


      <?php endforeach; ?>
    </div>
  </div>

<?php endif; ?>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
