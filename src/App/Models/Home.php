<?php

namespace Bonnefete\App\Models;

class Home
{

  protected $title;

  protected $author;

  protected $content;

  protected $date;

  public function __construct($title, $author, $content, $date)
  {
    $this->title = $title;
    $this->author = $author;
    $this->content = $content;
    $this->date = $date;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    if (strlen($title) > 2) {
      $this->title = $title;
    }
  }

  public function getAuthor(): string
  {
    return $this->author;
  }

  public function setAuthor(string $author): void
  {
    if (strlen($author) > 2) {
      $this->author = $author;
    }
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function setContent(string $content): void
  {
    if (strlen($content) > 2) {
      $this->content = $content;
    }
  }

  public function getDate(): string
  {
    return $this->date;
  }

  public function setDate(string $date): void
  {
    if (strlen($date) > 2) {
      $this->date = $date;
    }
  }
}
