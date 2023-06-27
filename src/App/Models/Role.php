<?php

namespace Bonnefete\App\Models;

class Role
{

  private $id;
  private $name;

  public function __construct()
  {
  }

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

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    if (strlen($name) > 2) {
      $this->name = $name;
    }
  }
}
