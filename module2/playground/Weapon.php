<?php
include_once('Product.php');

class Weapon extends Product {
  private $category = NULL;

  public function getCategory() {
    return $this->category;
  }

  public function setCategory($category) {
    $this->category = $category;
    return $this->category;
  }
}

 ?>
