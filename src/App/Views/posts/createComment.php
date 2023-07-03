<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<div class="create-form">
  <form class="post-create" action="../../post/createComment/ " method="post">
    <?php foreach ($posts as $post) : var_dump($posts)  ?>
      <input type="hidden" name="FK_Post_Id" value="<?php echo $posts['Post_Id'] ?>">
    <?php endforeach; ?>

    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label class="article" for="article">Contenu</label>
    <textarea name="article" id="article" cols="30" rows="10" maxlength="200" required></textarea>
    <button id="post" class="post">Publier</button>
  </form>
</div>
<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
