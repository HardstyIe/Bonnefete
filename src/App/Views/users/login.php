<?php

require_once '../Bonnefete/src/App/Views/head.php'; ?>


<form action="../user/login" method="post">
  <label for="email">E-mail</label>
  <input type="text" name="email" placeholder="email" required>

  <label for="password">Mot de passe</label>
  <input type="text" name="password" placeholder="password" required>


  <button>Se Connecter</button>
  <a class="register" href="/Bonnefete/user/register">Créer un compte</a>
</form>


<?php

require_once '../Bonnefete/src/App/Views/foot.php'; ?>