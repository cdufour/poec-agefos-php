<?php

// Aucune opération en base de données dans cette classe
// Comme dans Symfony, on utilisera une classe Manager
// pour les opérations en BD

class Author {
  private $id;
  private $firstname;
  private $lastname;
  private $birth_year;
  private $country;

  public function __construct($firstname, $lastname, $birth_year, $country) {
    $this->setFirstname($firstname);
    $this->setLastname($lastname);
    $this->setBirthYear($birth_year);
    $this->setCountry($country);
  }

  public function getId() { return $this->id; }
  public function getFirstname() { return $this->firstname; }
  public function getLastname() { return $this->lastname; }
  public function getBirthYear() { return $this->birth_year; }
  public function getCountry() { return $this->country; }

  public function setId($id) {
    $this->id = $id;
    return $this->id;
  }
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this->firstname;
  }
  public function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this->lastname;
  }
  public function setBirthYear($birth_year) {
    $this->birth_year = $birth_year;
    return $this->birth_year;
  }
  public function setCountry($country) {
    $this->country = $country;
    return $this->country;
  }

}

?>
