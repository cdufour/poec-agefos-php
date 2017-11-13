<?php

class Book {
  private $id;
  private $title;
  private $isbn;
  private $nb_pages;
  private $author;

  public function __construct($title, $isbn, $nb_pages) {
    // pour des raisons de rapidité, le prof se permet de ne pas
    // de ne pas utiliser de setters
    $this->title = $title;
    $this->isbn = $isbn;
    $this->nb_pages = $nb_pages;
  }

  public function getId() { return $this->id; }
  public function getTitle() { return $this->title; }
  public function getIsbn() { return $this->isbn; }
  public function getNbPages() { return $this->nb_pages; }
  public function getAuthor() { return $this->author; }

  public function setAuthor(Author $author) {
    $this->author = $author;
    return $this->author;
  }
}

?>
