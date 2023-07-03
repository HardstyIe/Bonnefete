<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<div class="create-form">
  <form class="post-create" action="../post/CreateComment/ " method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <label class="content" for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="200" required></textarea>
    <button id="post" class="post">Publier</button>
  </form>
</div>
<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
