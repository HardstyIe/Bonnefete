<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<!-- fait moi un tableau tailwind qui repertorie tous mes utilisateur , avec l'option de modifier ou supprimer l'utilisateur -->
<?php if ($_SESSION['users']['rolename'] == 'Administrateur' || $_SESSION['users']['rolename'] == 'SuperAdministrateur') : ?>
  <main class="h-screen">
    <div class="flex flex-col w-4/5 text-center user-list">
      <h1 class="text-4xl font-bold">Liste des utilisateurs</h1>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">Prénom</th>
            <th class="px-4 py-2">Nom</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Nombre de post</th>
            <th class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td class="px-4 py-2 border"><?= $user['surname'] ?></td>
              <td class="px-4 py-2 border"><?= $user['name'] ?></td>
              <td class="px-4 py-2 border"><?= $user['email'] ?></td>
              <td class="px-4 py-2 border"><?= $user['nb_posts'] ?></td>
              <td class="flex px-4 py-2 border h-14 ">
                <a href="/Bonnefete/user/update/<?= $user['id'] ?>" class="px-4 my-auto py-2 font-bold text-black  rounded hover:bg-blue-700">Modifier</a>
                <form action="../user/deleteUser/<?= $user['id'] ?>" method="post" class="px-3 py-1 m-0 font-bold text-black  rounded hover:bg-red-700">
                  <button type="submit" class="text-black text ">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

<?php else : ?>

  <main class="flex flex-col items-center justify-center">
    <h1 class="text-4xl font-bold">Vous n'avez pas accés a cette page</h1>
  <?php endif; ?>

  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
