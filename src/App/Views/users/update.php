<?php require_once('./src/App/Views/head.php') ?>

<?php include_once('./src/utils/console_log.php') ?>

<h1 id="user-profile-edit">Modifier l'utilisateur</h1>

<form class="edit-user-profile" action="/Bonnefete/user/update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">

  <input type="hidden" name="id" value="<?= $user['id'] ?>">

  <label for="email">Adresse e-mail:</label>
  <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>

  <label for="prenom">Prénom:</label>
  <input type="text" id="prenom" name="prenom" value="<?= $user['surname'] ?>" required>

  <label for="nom">Nom:</label>
  <input type="text" id="nom" name="nom" value="<?= $user['name'] ?>" required>

  <label for="password">Nouveau mot de passe:</label>
  <input type="password" id="password" name="password" value="">

  <label for="avatar">Avatar:</label>
  <input type="file" id="avatar" name="avatar">

  <?php if ($_SESSION['users']['FK_role_id'] === 1) : // SuperAdministrateur 
  ?>
    <div class="user-class">
      <label for="role">Rôle:</label>
      <select name="role" id="role">
        <?php foreach ($roles as $role) : ?>
          <option value="<?php echo $role['id']; ?>" <?php if ($role['rolename'] === $user['rolename']) echo 'selected'; ?>>
            <?php echo $role['rolename']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php elseif ($_SESSION['users']['FK_role_id'] === 2 && $user['FK_role_id'] === 3) : // Administrateur pouvant changer le rôle de Utilisateur 
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="2" <?= ($user['FK_role_id'] == 2) ? 'selected' : '' ?>>Administrateur</option>
        <option value="3" <?= ($user['FK_role_id'] == 3) ? 'selected' : '' ?>>Utilisateur</option>
      </select>
    </div>

  <?php elseif ($_SESSION['users']['FK_role_id'] === 2 && $user['FK_role_id'] === 2) : // Administrateur ne pouvant pas changer le rôle de Administrateur
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="2" <?= ($user['FK_role_id'] == 2) ? 'selected' : '' ?>>Administrateur</option>
      </select>
    </div>

  <?php elseif ($_SESSION['users']['FK_role_id'] === 3) : // Utilisateur ne pouvant pas changer le rôle de Administrateur ou de Utilisateur
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="3" <?= ($user['FK_role_id'] == 3) ? 'selected' : '' ?>>Utilisateur</option>
      </select>
    </div>


  <?php endif; ?>


  <div>
    <button type="submit">Mettre à jour</button>
  </div>
</form>


<?php require_once('./src/App/Views/foot.php') ?>
