<?php require_once('./src/App/Views/head.php') ?>

<?php include_once('./src/utils/console_log.php') ?>

<h1>Modifier l'utilisateur</h1>

<form action="/Bonnefete/user/update/<?= $user['User_Id'] ?>" method="post" enctype="multipart/form-data">

  <input type="hidden" name="id" value="<?= $user['User_Id'] ?>">

  <label for="email">Adresse e-mail:</label>
  <input type="email" id="email" name="email" value="<?= $user['User_Email'] ?>" required>

  <label for="prenom">Prénom:</label>
  <input type="text" id="prenom" name="prenom" value="<?= $user['User_Surname'] ?>" required>

  <label for="nom">Nom:</label>
  <input type="text" id="nom" name="nom" value="<?= $user['User_Name'] ?>" required>

  <label for="password">Nouveau mot de passe:</label>
  <input type="password" id="password" name="password" value="">

  <label for="avatar">Avatar:</label>
  <input type="file" id="avatar" name="avatar">

  <?php if ($_SESSION['user']['FK_Role_Id'] === 1) : // SuperAdministrateur 
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select name="role" id="role">
        <?php foreach ($roles as $role) : ?>
          <option value="<?php echo $role['Role_Id']; ?>" <?php if ($role['Role_Name'] === $user['Role_Name']) echo 'selected'; ?>>
            <?php echo $role['Role_Name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php elseif ($_SESSION['user']['FK_Role_Id'] === 2 && $user['FK_Role_Id'] === 3) : // Administrateur pouvant changer le rôle de Utilisateur 
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="2" <?= ($user['FK_Role_Id'] == 2) ? 'selected' : '' ?>>Administrateur</option>
        <option value="3" <?= ($user['FK_Role_Id'] == 3) ? 'selected' : '' ?>>Utilisateur</option>
      </select>
    </div>

  <?php elseif ($_SESSION['user']['FK_Role_Id'] === 2 && $user['FK_Role_Id'] === 2) : // Administrateur ne pouvant pas changer le rôle de Administrateur
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="2" <?= ($user['FK_Role_Id'] == 2) ? 'selected' : '' ?>>Administrateur</option>
      </select>
    </div>

  <?php elseif ($_SESSION['user']['FK_Role_Id'] === 3) : // Utilisateur ne pouvant pas changer le rôle de Administrateur ou de Utilisateur
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="3" <?= ($user['FK_Role_Id'] == 3) ? 'selected' : '' ?>>Utilisateur</option>
      </select>
    </div>


  <?php endif; ?>


  <div>
    <button type="submit">Mettre à jour</button>
  </div>
</form>


<?php require_once('./src/App/Views/foot.php') ?>
