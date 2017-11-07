<?php
include('Color.php'); // inclusion de la classe Color
include_once('Product.php');
include_once('Book.php');
include_once('Weapon.php');

class Player {
  // propriétés
  public $firstname = "";
  public $lastname = "";
  public $team = "";
  public $age = NULL;

  // méthodes (functions à l'intérieur d'une classe)
  public function getfullName() {
    //$firstname = ""; variable "locale"
    return $this->firstname . ' ' . $this->lastname;
  }

  public function ageAfterTenYears() {
    return $this->age + 10;
  }

  public function ageAfterNbYears($nbYears) {
    return $this->age + $nbYears;
  }

  public function ageAfterTenYearsAlter() {
    $this->age += 10; // valeur modifiée (altérée)
    return $this->age;  // retour de la nouvelle
  }

}


$player1 = new Player();
$player2 = new Player();
$player3 = new Player();

$player1->firstname = "Andrea"; // accès en écriture
$player1->lastname = "Pirlo";

// echo $player1->getfullName(); // affiche Andrea Pirlo
// echo $player2->getfullName();
//
// $player1->age = 56;
// echo $player1->ageAfterTenYears(); // affiche 66
// echo $player1->ageAfterNbYears(25); // affiche 81 (56 + 25)
// echo $player1->ageAfterTenYearsAlter(); // affiche 66
// echo $player1->ageAfterNbYears(25); // affiche 91 (66 + 25)

//var_dump($player1);
//var_dump($player2);

$color1 = new Color("red");
$color2 = new Color("orange");

//echo $color1->convertToHexa(); // FF00000

// echo ($color2->convertToHexa())
//   ? 'Couleur trouvée'
//   : 'Couleur non trouvée';

//echo $color1->convertToRgb();

$product1 = new Product("Tondeuse à gazon");
$product1->setPrice(14.6);
$product1->setAvailable(true);
//var_dump($product1);
//echo $product1->test;
//echo $product1->test2;
//echo $product1->CONSTANTE_DE_CLASSE; IMPOSSIBLE !!!!!!!!!!
//echo Product::CONSTANTE_DE_CLASSE;
echo '<p></p>';

$book1 = new Book("Le Père Goriot");
//$book1->setPrice(5.40);
$book1->setNbPages(450);
//var_dump($book1);
//echo $book1->getPrice();
//echo $book1->test;
//echo $book1->test2; // Fatal ERROR (propriété protégée)
//echo $book1->getTest2();
echo '<p></p>';

$weapon1 = new Weapon("Pic à glace");
$weapon1->setPrice(60);
$weapon1->setCategory(6);
//var_dump($weapon1);


?>
