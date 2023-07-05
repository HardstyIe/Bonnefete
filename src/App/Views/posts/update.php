<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<div class="create-form">
  <form class="post-create" action="../../post/update/<?php echo $post['Post_Id']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post['Post_Id'] ?>">
    <input type="hidden" name="old_image" value="<?= $post['FK_Image_Id'] ?>">

    <label for="title">Titre</label>
    <input type="text" name="title" id="title">
    <label class="article" for="article">Contenu</label>
    <textarea name="article" id="article" cols="30" rows="10" maxlength="200" required></textarea>
    <div>
      <label for="image">Sélectionnez une image :</label>
      <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" src="#" alt="Aperçu de l'image" style="max-width: 200px; display: none;">
    </div>

    <button type="submit" class="post" id="post">Publier</button>
  </form>
</div>


<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
