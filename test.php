<?php
include('lib/functions.php');
ini_set('display_errors', 1); // erreurs affichées dans le navigateur
?>

<?php
// test de la function moyenne()
echo moyenne([8, 12], 2); // => 10
echo moyenne([8, 12, 2], 2); // => 7.33
echo moyenne([], 0); // => "Aucune note"

?>

<p>Paragraphe</p>
<?php

// PHP est un langage à typage dynamique
// TYPES SIMPLES
$v = "bonjour"; // string
echo $v;
echo majusculeInitiale($v);
echo gettype($v);

$v = 14; // integer
echo $v;
echo gettype($v);

$v = 14.7; // double
echo $v;
echo gettype($v);

$v = true; // boolean
echo $v;
echo gettype($v);

$v2 = NULL; // NULL
echo gettype($v2);

// opérations sur integer
$nb1 = 45;
$nb2 = 2;
$nb3 = "3";
echo $nb1 * $nb3; // conversion implicite de $nb3 en integer
// => 135

$str1 = "Un tiens vaut mieux";
$str2 = "Que deux tu l'auras";
echo "<h2>" . $str1 . " " . $str2 . "</h2>"; // concaténation

// TYPES COMPLEXES
// tableaux à indice numérique (commence à 0)
$tableau = [];
$tableau2 = array();
echo gettype($tableau);
echo gettype($tableau2);

$etudiants = ['étudiant 1', "étudiant 2", "étudiant3"];
echo $etudiants[2]; // étudiant3
$etudiants[0] = "Samir"; // accès en écriture
echo $etudiants[0];

$mix = ["chaîne", 45, false, NULL, $etudiants];
echo $mix[4][0]; // tableau à deux dimensions

// tableaux associatifs
$joueurs = array(
  'joueur1' => array(
    'nom' => 'Messi',
    'prenom' => 'Lionel',
    'maillot' => 10
  )
);

echo "<br>";
echo $joueurs['joueur1']['prenom'];
echo " ";
echo $joueurs['joueur1']['nom'];

$j1 = array('prenom' => 'Paolo', 'nom' => 'Dybala', 'maillot' => 10);
$j2 = array('prenom' => 'Giorgio', 'nom' => 'Chiellini', 'maillot' => 3);
$j3 = array('prenom' => 'Andrea', 'nom' => 'Barzagli', 'maillot' => 15);

$juve = array($j1, $j2, $j3);

// mise à jour du numéro de maillot du joueur Dybala
// deux solutions
$j1['maillot'] = 21;
$juve[0]['maillot'] = 21;

// Structures itératives
// boucle for
echo '<ul>';
for($i=0; $i<sizeof($juve); $i++) {
  echo '<li>' . $juve[$i]['prenom'] . ' ' . $juve[$i]['nom'] . '</li>';
}
echo '</ul>';

// boucle while
$compteur = 0;
echo '<select>';
while ($compteur < sizeof($juve)) {
  echo '<option>' . $juve[$compteur]['maillot'] . '</option>';
  $compteur++;
}
echo '</select>';


foreach($juve as $j) {
  if ($j['maillot'] == 21) {
    echo '<p style="color:red">' . $j['nom'] . ' (meneur de jeu)</p>';
  } else {
    echo '<p>' . $j['nom'] . '</p>';
  }
}


?>
