<?php

namespace Bonnefete\App\Models;

class Like
{

  protected $FK_User_Id;

  protected $FK_Post_Id;

  public function __construct($FK_User_Id, $FK_Post_Id)
  {
    $this->FK_User_Id = $FK_User_Id;
    $this->FK_Post_Id = $FK_Post_Id;
  }

  public function getFK_User_Id(): string
  {
    return $this->FK_User_Id;
  }

  public function setFK_User_Id(string $FK_User_Id): void
  {
    if (strlen($FK_User_Id) > 2) {
      $this->FK_User_Id = $FK_User_Id;
    }
  }

  public function getFK_Post_Id(): string
  {
    return $this->FK_Post_Id;
  }

  public function setFK_Post_Id(string $FK_Post_Id): void
  {
    if (strlen($FK_Post_Id) > 2) {
      $this->FK_Post_Id = $FK_Post_Id;
    }
  }
}
