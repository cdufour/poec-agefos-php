<?php
$db = new PDO('mysql:host=localhost;dbname=quizz', 'root', 'paris');
// $db est un objet de type PDO, il contient des propriétés et
// des méthodes permettant d'interagir avec la BD
//var_dump($db);

// -> query();
$sql = 'SELECT * FROM stagiaire';
//$db->query($sql);

// fetch
// lignes sql transformées en tableaux PHP (à la fois assoc et num)
foreach($db->query($sql, PDO::FETCH_OBJ) as $s) {
  //echo '<p>ASSOC ' . $s['nom'] . '</p>';
  //echo '<p>NUM ' . $s[1] . '</p>';
  echo '<p>OBJ ' . $s->nom . '</p>';
}


?>

<h1>Module 2</h1>
<!-- création d'une application quizz -->
