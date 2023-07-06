<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>


<div class="w-full max-w-3xl h-screen rounded-lg  create-form">
  <form class="flex flex-col items-center w-full p-8 mx-auto bg-white border-2 border-gray-300 post-create" action="../../post/createComment/" method="post" enctype="multipart/form-data">
    <input type="hidden" name="FK_post_id" value="<?php echo $posts['id'] ?>">

    <label for="content" class="mb-2 text-gray-800">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="200" required class="block w-full p-2 mb-4 border-gray-300 rounded-lg focus:outline-none focus:border-gray-500"></textarea>
    <button id="post" class="px-4 py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-700">Publier</button>
  </form>
</div>
<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
