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
}

?>
