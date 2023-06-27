<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<form action="../post/create" method="post">
  <div>
    <label for="title">Titre</label>
    <input type="text" name="title" id="title">
  </div>
  <div>
    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
  </div>
  <div>
    <label for="date">Date</label>
    <input type="date" name="date" id="date">

  </div>
  <button>Publier</button>
</form>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
