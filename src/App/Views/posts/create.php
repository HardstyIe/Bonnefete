<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<div class="create-form">
  <form class="post-create" action="../post/create/ " method="post" enctype="multipart/form-data">
    <label for=" title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label class="content" for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="200" required></textarea>
    <label for="image">Vous pouvez publier des images Ici</label>
    <input type="file" name="image" id="image">
    <button id="post">Publier</button>
  </form>
  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
</div>