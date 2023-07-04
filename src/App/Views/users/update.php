<?php require_once('./src/App/Views/head.php') ?>

<h1>Modifier l'utilisateur</h1>

<form action="../../../Bonnefete/user/update" method="post" enctype="multipart/form-data">

  <input type="hidden" name="id" value="<?= $user['User_Id'] ?>">

  <div>
    <label for="email">Adresse e-mail:</label>
    <input type="email" id="email" name="email" value="<?= $user['User_Email'] ?>" required>
  </div>

  <div>
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" value="<?= $user['User_Surname'] ?>" required>
  </div>

  <div>
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?= $user['User_Name'] ?>" required>
  </div>

  <div>
    <label for="password">Nouveau mot de passe:</label>
    <input type="password" id="password" name="password">
  </div>

  <div>
    <label for="avatar">Avatar:</label>
    <input type="file" id="avatar" name="avatar">
  </div>

  <?php if ($_SESSION['user']['FK_Role_Id'] === 1) : // SuperAdministrateur 
  ?>
    <div>
      <label for="role">Rôle:</label>
      <select id="role" name="role">
        <option value="1" <?= ($user['FK_Role_Id'] == 1) ? 'selected' : '' ?>>SuperAdministrateur</option>
        <option value="2" <?= ($user['FK_Role_Id'] == 2) ? 'selected' : '' ?>>Administrateur</option>
        <option value="3" <?= ($user['FK_Role_Id'] == 3) ? 'selected' : '' ?>>Utilisateur</option>
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
  <?php endif; ?>

  <div>
    <button type="submit">Enregistrer</button>
  </div>
</form>


<?php require_once('./src/App/Views/foot.php') ?>
