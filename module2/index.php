<?php
session_start(); // ouverture/accès session
include('routes.php');
$db = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8', 'root', 'paris');

if (isset($_GET['route'])) {
  $route = $_GET['route'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Module 2: Quizz App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>

    <header>
      <nav>
        <ul class="nav nav-tabs">

          <?php if(isset($_SESSION['admin'])): ?>
          <li><a href="?route=question/list">Liste des questions</a></li>
          <li><a href="?route=question/add">Ajouter une question</a></li>
          <li><a href="?route=category/manage">Catégories</a></li>
          <?php endif ?>

          <li><a href="?route=qcm">QCM</a></li>

          <?php if(isset($_SESSION['admin'])): ?>
            <li>
              <a href="?route=logout">
                <span>Bienvenue à <strong><?= $_SESSION['admin'] ?></strong></span>
                 (Déconnexion)
              </a>
            </li>
          <?php else: ?>
            <li><a href="?route=login">Connexion</a></li>
          <?php endif ?>
        </ul>
      </nav>
    </header>

    <h1>Module 2: Quizz App</h1>
    <?php
    if (isset($route)) include($routes[$route]);
    ?>
  </body>
</html>
