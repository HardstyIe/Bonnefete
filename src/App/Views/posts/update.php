<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<div class="w-1/2 h-screen rounded-lg  create-form">
  <form class="flex flex-col items-center w-full p-8 mx-auto bg-white border-2 border-gray-300 post-create" action="../../post/update/<?php echo $post[0]['id']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post[0]['id'] ?>">
    <input type="hidden" name="old_image" value="<?= $post[0]['FK_image_id'] ?>">
    <label for="title" class="mb-2 text-gray-800">Titre</label>
    <input type="text" name="title" id="title" required class="block w-full p-2 mb-4 border-gray-300 rounded-lg focus:outline-none focus:border-gray-500">

    <label for="article" class="mb-2 text-gray-800">Contenu</label>
    <textarea name="article" id="article" cols="30" rows="10" maxlength="200" required class="block w-96 p-2 mb-4 border-gray-300  rounded-lg bg-gray-300 focus:outline-none focus:border-gray-500"></textarea>

    <div class="w-96">
      <label for="image" class="mb-2 text-gray-800">Vous pouvez publier des images ici</label>
      <input type="file" name="image" id="image" class="mb-4" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" src="#" alt="Aperçu de l'image" style="max-width: 200px; display: none;">
    </div>
    <button id="post" class="px-4 py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-700">Publier</button>
  </form>
</div>

<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
