<?php
include_once('Product.php');

class Book extends Product {

  /*
  private: inaccessible depuis l'extérieur,
  accessible seulement à l'intérieur de la classe.
  Non "écrasable" par une classe héritière.
  Si la classe fille définit une propriété portant le même
  nom que dans la classe mère => doublon généré

  protected: inaccessible depuis l'extérieur,
  accessible seulement à l'intérieur de la classe.
  "Ecrasable" par une classe héritière.
  Si la classe fille définit une propriété portant le même
  nom que dans la classe mère => cette propriété remplace celle provenant
  de la classe mère

  public: accessible depuis l'extérieur.
  "Ecrasable" par une classe héritière.
  Si la classe fille définit une propriété portant le même
  nom que dans la classe mère => cette propriété remplace celle provenant
  de la classe mère
  */

  private $price = 12.3;
  private $nbPages = NULL;
  public $test = "public test Book";
  protected $test2 = "protected test2 Book";

  // le constructeur de l'enfant remplace celui du parent
  // il ne peut y avoir qu'une seul constructeur par classe
  public function __construct() {

  }

  public function getTest2() {
    return $this->test2; // renvoie la valeur de la propriété protégée
  }

  public function getNbPages() {
    return $this->nbPages;
  }

  public function setNbPages($nbPages) {
    $this->nbPages = $nbPages;
    return $this->nbPages;
  }

}

 ?>
