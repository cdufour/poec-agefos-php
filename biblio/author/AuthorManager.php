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

  public function list() {
    // récupération des données SQL
    $query = $this->db->prepare('SELECT * FROM author ORDER BY lastname ASC');
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $authors = array();
    // transformation des résultats SQL en objets de type Author
    foreach($results as $r) {
      // A chaque itération nous crééons un nouvel objet Author
      $author = new Author($r->firstname, $r->lastname,
        $r->birth_year, $r->country);

      // nous renseignons également l'id de l'author via le setter approprié
      $author->setId($r->id); // à cette étape, l'hydration est complète

      // ajout de l'author dans le tableau
      array_push($authors, $author);
    }
    return $authors; // retourne le tableau d'objets de type Author
  }

  public function deleteById($id) {
    $query = $this->db->prepare('DELETE FROM author WHERE id = :id');
    $result = $query->execute(array(':id' => $id));
    return $result;
  }

  public function getById($id) {
    $query = $this->db->prepare('SELECT * FROM author WHERE id = :id');
    $query->execute(array(':id' => $id));
    $result = $query->fetch(PDO::FETCH_OBJ);

    // transformation de l'objet PDO $result en objet de type Author
    $author = new Author(
      $result->firstname,
      $result->lastname,
      $result->birth_year,
      $result->country
    );
    $author->setId($result->id); // hydratation complète
    return $author;
  }

  public function getBooks($author_id) {
    // A faire
    // renvoie un tableau d'objets Book
  }

}

?>
