<?php
session_start(); // permet d'accéder à la session ouverte
// ou bien d'en ouvrir une si la session n'existe pas déjà
var_dump($_SESSION);

?>
<h1>Session 2</h1>
<h2>Bonjour <?= $_SESSION['username'] ?></h2>
