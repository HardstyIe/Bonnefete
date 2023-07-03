<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<div class="create-form">
  <form class="post-create" action="../../post/update/" method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label class="article" for="article">Contenu</label>
    <textarea name="article" id="article" cols="30" rows="10" maxlength="200" required></textarea>
    <button class="post" id="post">Publier</button>
  </form>

  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
