<?php

namespace App;

use PDO;



class Database
{

  protected $host = '';
  protected $dbname = '';
  protected $user = '';
  protected $password = '';

  protected $pdo;

  public function __construct()
  {
    $this->host = $_ENV['DB_HOST'];
    $this->dbname = $_ENV['DB_NAME'];
    $this->user = $_ENV['DB_USER'];
    $this->password = $_ENV['DB_PASSWORD'];
    try {
      $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo "Erreur de connexion à la base de données";
    }
  }

  public function getPdo()
  {
    return $this->pdo;
  }
}