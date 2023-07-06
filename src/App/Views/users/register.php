<?php

require_once '../Bonnefete/src/App/Views/head.php'; ?>


<!-- <form action="../user/register" method="post">
  <label for="email">E-mail</label>
  <input type="email" name="email" placeholder="email" required>

  <label for="prenom">Prénom</label>
  <input type="text" name="prenom" placeholder="prenom" required>

  <label for="nom">Nom</label>
  <input type="text" name="nom" placeholder="nom" required>

  <label for="password">Mot de passe</label>
  <input type="password" name="password" placeholder="password" required>


  <button>S'inscrire</button>
</form> -->


<div class="flex flex-col justify-center w-full max-w-3xl min-h-full px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">

    <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Enregistrez-Vous</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="../user/register" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse mail</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom</label>

        </div>
        <div class="mt-2">
          <input id="nom" name="nom" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prénom</label>

        </div>
        <div class="mt-2">
          <input id="prenom" name="prenom" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>

        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md  px-3 py-1.5 text-sm font-semibold bg-primary leading-6 text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">Se
          S'enregistrer</button>
      </div>
    </form>

  </div>
</div>


<?php
require_once '../Bonnefete/src/App/Views/foot.php'; ?>
