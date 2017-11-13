<?php

class AuthorManager {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function save(Author $author) {
    $query = $this->db->prepare(
      ' INSERT INTO author (firstname, lastname, birth_year, country)
        VALUES (:firstname, :lastname, :birth_year, :country)
      ');
    $result = $query->execute(array(
      ':firstname' => $author->getFirstname(),
      ':lastname' => $author->getLastname(),
      ':birth_year' => $author->getBirthYear(),
      ':country' => $author->getCountry(),
    ));
    return $result;
  }
}

?>
