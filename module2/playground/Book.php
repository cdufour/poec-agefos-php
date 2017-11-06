<?php
include_once('Product.php');

class Book extends Product {
  private $nbPages = NULL;

  public function getNbPages() {
    return $this->nbPages;
  }

  public function setNbPages($nbPages) {
    $this->nbPages = $nbPages;
    return $this->nbPages;
  }

}

 ?>
