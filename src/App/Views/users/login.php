<?php

require_once '../Bonnefete/src/App/Views/head.php'; ?>

<div class="flex flex-col justify-center w-full max-w-3xl min-h-full px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">

    <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">Connectez-Vous</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="../user/login" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse mail</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
          Connectez</button>
      </div>
    </form>
    <div class="mt-4">
      <a href="/Bonnefete/user/register" type="submit" class="flex w-full justify-center rounded-md  px-3 py-1.5 text-sm font-semibold bg-primary leading-6 text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">S'enregistrer</a>
    </div>
  </div>
</div>

<?php

require_once '../Bonnefete/src/App/Views/foot.php'; ?>
