<?php

namespace Bonnefete\App\Models;

class Like
{

  protected $FK_user_id;

  protected $FK_post_id;

  public function __construct($FK_user_id, $FK_post_id)
  {
    $this->FK_user_id = $FK_user_id;
    $this->FK_post_id = $FK_post_id;
  }

  public function getFK_user_id(): string
  {
    return $this->FK_user_id;
  }

  public function setFK_user_id(string $FK_user_id): void
  {
    if (strlen($FK_user_id) > 2) {
      $this->FK_user_id = $FK_user_id;
    }
  }

  public function getFK_post_id(): string
  {
    return $this->FK_post_id;
  }

  public function setFK_post_id(string $FK_post_id): void
  {
    if (strlen($FK_post_id) > 2) {
      $this->FK_post_id = $FK_post_id;
    }
  }
}
