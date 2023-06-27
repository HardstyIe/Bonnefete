<?php

require_once '../Bonnefete/src/App/Views/head.php'; ?>


<form action="../user/login" method="post">
  <label for="email">E-mail</label>
  <input type="text" name="email" placeholder="email" required>

  <label for="password">Mot de passe</label>
  <input type="text" name="password" placeholder="password" required>


  <button>Se Connecter</button>
  <a href="/Bonnefete/user/register">Créer un compte</a>
</form>


<?php

require_once '../Bonnefete/src/App/Views/foot.php'; ?>

<style>
  
  form {
    border-radius: 5px;
    font-size: 1.3em;
    width: 50%;
    margin: 12% auto;
    background-color: #d9d9d9;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  label, button {
    color: #38413d;
    margin: 1%;
  }

  input {
    border-radius: 2px;
    align-items: center;
    padding-left: 5px;
  }

  button, a {
    margin-top: 5%;
  }

  a {
    color: #38413d;
    text-decoration: none;
  }
</style>
