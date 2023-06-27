<?php

require_once '../Bonnefete/src/App/Views/head.php'; ?>


<form action="../user/register" method="post">
  <label for="email">E-mail</label>
  <input type="text" name="email" placeholder="email" required>

  <label for="prenom">Prénom</label>
  <input type="text" name="prenom" placeholder="prenom" required>

  <label for="nom">Nom</label>
  <input type="text" name="nom" placeholder="nom" required>

  <label for="password">Mot de passe</label>
  <input type="text" name="password" placeholder="password" required>


  <button>S'inscrire</button>
</form>





<?php
require_once '../Bonnefete/src/App/Views/foot.php'; ?>