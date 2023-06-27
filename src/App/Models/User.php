<?php

namespace Bonnefete\App\Models;



class User
{
  protected $id;
  protected $email;
  protected $prenom;
  protected $nom;
  protected $password;
  protected $role;

  public function getId(): int
  {
    return $this->id;
  }
  public function setId(int $id): void
  {
    if ($id > 0) {
      $this->id = $id;
    }
  }
  public function getEmail(): string
  {
    return $this->email;
  }
  public function setEmail(string $email): void
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
    }
  }
  public function getPrenom(): string
  {
    return $this->prenom;
  }
  public function setPrenom(string $prenom): void
  {
    if (strlen($prenom) > 2) {
      $this->prenom = $prenom;
    }
  }
  public function getNom(): string
  {
    return $this->nom;
  }
  public function setNom(string $nom): void
  {
    if (strlen($nom) > 2) {
      $this->nom = $nom;
    }
  }
  public function getPassword(): string
  {
    return $this->password;
  }
  public function setPassword(string $password): void
  {
    if (strlen($password) > 2) {
      $this->password = $password;
    }
  }

  public function getRole(): Role
  {
    return $this->role;
  }

  public function setRole(Role $role): void
  {
    $this->role = $role;
  }
}
