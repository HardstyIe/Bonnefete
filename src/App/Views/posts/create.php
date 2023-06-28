<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<div class="post-create">
  <form action="../post/create" method="post">

    <label for="title">Titre</label>
    <input type="text" name="title" id="title">


    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>

    <button>Publier</button>
  </form>

  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>