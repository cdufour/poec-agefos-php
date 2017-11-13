<?php
include('routes.php');
$db = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', 'paris');
if (isset($_GET['route'])) $route = $_GET['route'];
?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>TP3 : BiblioApp</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   </head>
   <body>
     <h1>TP3 : BiblioApp</h1>
     <nav>
       <ul>
         <li><a href="index.php?route=books">Livres</a></li>
         <li><a href="index.php?route=authors">Auteurs</a></li>
       </ul>
     </nav>
     <?php if (isset($route)) include($routes[$route]);?>
   </body>
 </html>
