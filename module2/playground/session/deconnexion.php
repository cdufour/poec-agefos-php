<?php
session_start(); // accède à la session courante

session_destroy(); // détruit la session
// IMPORTANT, il faut d'abord accéder à la session avant de
// pouvoir la détruire

header('location:session2.php'); // redirection

?>
