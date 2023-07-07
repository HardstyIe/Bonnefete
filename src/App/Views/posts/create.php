<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>
<div class=" h-screen create-form w-1/2 rounded-lg">
  <form class="w-full p-8 mx-auto bg-white border-2 border-gray-300  post-create flex flex-col items-center" action="../post/create/" method="post" enctype="multipart/form-data">
    <label for="title" class="mb-2 text-gray-800">Titre</label>
    <input type="text" name="title" id="title" required class="block w-full p-2 mb-4 border-gray-300 rounded-lg focus:outline-none focus:border-gray-500">

    <label for="content" class="mb-2 text-gray-800">Contenu</label>
    <textarea name="content" id="content" cols="30" rows="10" maxlength="200" required class="block w-full p-2 mb-4 border-gray-300 rounded-lg focus:outline-none focus:border-gray-500"></textarea>

    <label for="image" class="mb-2 text-gray-800">Vous pouvez publier des images ici</label>
    <input type="file" name="image" id="image" class="mb-4">

    <button id="post" class="px-4 py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-700">Publier</button>
  </form>
</div>


<?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
