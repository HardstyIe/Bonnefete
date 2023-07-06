<?php require_once '../Bonnefete/src/App/Views/head.php'; ?>

<!-- fait moi un tableau tailwind qui repertorie tous mes utilisateur , avec l'option de modifier ou supprimer l'utilisateur -->
<?php if ($_SESSION['users']['name'] == "Administrateur" || "SuperAdministrateur") : ?>
  <main class="flex flex-col items-center justify-center">
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
        <?php foreach ($users as $user) : console_log($_SESSION['users'], true) ?>
          <tr>
            <td class="px-4 py-2 border"><?= $user['surname'] ?></td>
            <td class="px-4 py-2 border"><?= $user['name'] ?></td>
            <td class="px-4 py-2 border"><?= $user['email'] ?></td>
            <td class="px-4 py-2 border"><?= $user['nb_posts'] ?></td>
            <td class="px-4 py-2 border">
              <a href="/Bonnefete/user/update/<?= $user['id'] ?>" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Modifier</a>
              <a href="/Bonnefete/user/delete/<?= $user['id'] ?>" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

<?php else : ?>

  <main class="flex flex-col items-center justify-center">
    <h1 class="text-4xl font-bold">Vous n'avez pas accés a cette page</h1>
  <?php endif; ?>

  <?php require_once '../Bonnefete/src/App/Views/foot.php'; ?>
