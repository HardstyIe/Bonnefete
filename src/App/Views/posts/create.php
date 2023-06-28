<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>


  <form class="post-create" action="../post/create" method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label class="content" for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="200" required></textarea>
    <button id="post" >Publier</button>
    <button class="post">Publier</button>
  </form>



<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>