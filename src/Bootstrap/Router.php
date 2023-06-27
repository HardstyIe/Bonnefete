<?php

namespace Bonnefete\Bootstrap;

require 'src/App/Controllers/UserController.php';
require 'src/App/Controllers/RoleController.php';
class Router
{
  protected $requestUri;
  protected $requestMethod;

  public function __construct($requestUri, $requestMethod)
  {
    $this->requestUri = $this->removeSubdirectoryFromUri($requestUri, '/Bonnefete');
    $this->requestMethod = $requestMethod;
  }

  protected function removeSubdirectoryFromUri($uri, $subdirectory)
  {
    return substr($uri, strlen($subdirectory));
  }

  public function route()
  {
    // Supprimer les slashes au début et à la fin de l'URI et le diviser en segments
    $segments = explode('/', trim($this->requestUri, '/'));
    $controllerName = ucfirst(array_shift($segments)) . 'Controller';
    $actionName = strtolower($this->requestMethod) . ucfirst(array_shift($segments));
    // Ajouter le namespace complet aux contrôleurs

    $controllerName = '\\Bonnefete\\App\\Controllers\\' . $controllerName;

    // Si le contrôleur n'existe pas ou que la méthode n'existe pas, afficher une erreur 404
    if (!class_exists($controllerName) || !method_exists($controllerName, $actionName)) {
      header("HTTP/1.0 404 Not Found");
      echo "Page not found";
      exit;
    }

    // Instancier le contrôleur et appeler la méthode d'action
    $controller = new $controllerName;
    call_user_func_array([$controller, $actionName], $segments);
  }
}
