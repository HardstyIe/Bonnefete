<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<div class="create-form">
  <form class="post-create" action="../../post/createComment/ " method="post">
    <input type="hidden" name="FK_post_id" value="<?php echo $posts['id'] ?>">


    <label class="article" for="article">Contenu</label>
    <textarea name="article" id="article" cols="30" rows="10" maxlength="200" required></textarea>
    <button id="post" class="post">Publier</button>
  </form>
</div>
<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
