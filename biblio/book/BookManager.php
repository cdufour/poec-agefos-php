<?php

class BookManager {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function list() {
    // A faire
  }

  public function deleteById($id) {
    // A faire
  }

  public function save(Book $book) {
    $query = $this->db->prepare(
      ' INSERT INTO book (title, isbn, nb_pages, author)
        VALUES (:title, :isbn, :nb_pages, :author)
      ');
      // afin d'être en conformité avec les attendues par SQL
      // (la colonne book.author attend un INT), on execute
      // la méthode .getId() de l'objet Author renvoyé par $book->getAuthor()
    $result = $query->execute(array(
      ':title' => $book->getTitle(),
      ':isbn' => $book->getIsbn(),
      ':nb_pages' => $book->getNbPages(),
      ':author' => $book->getAuthor()->getId()
    ));
    return $result;
  }


}

?>
