<?php
session_start(); // création d'une session

// ajout de clés et de valeurs dans la super-globale $_SESSION
$_SESSION['username'] = 'Abdel';
$_SESSION['password'] = 123;
var_dump($_SESSION);

?>

<h1>SESSION</h1>
<h2>Bonjour <?= $_SESSION['username'] ?></h2>
<ul>
  <li><a href="session2.php">Page session 2</a></li>
  <li><a href="deconnexion.php">Déconnexion</a></li>
</ul>
