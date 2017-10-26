<?php
include('lib/functions.php');

$title = "Formation PHP";

$stagiaires = array(
  array(
    'nom' => 'abecassis',
    'prenom' => 'stéPHane',
    'totem' => 'abeille.jpg',
    'notes' => array(8,12,18)),
  array(
    'nom' => 'chauvet',
    'prenom' => 'stevens',
    'totem' => 'paresseux.jpg',
    'notes' => array(4,20,10)),
  array(
    'nom' => 'grivel',
    'prenom' => 'sébastien',
    'totem' => 'tigre.jpg',
    'notes' => array(14,14,14,18)),
  array(
    'nom' => 'àjafari',
    'prenom' => 'sajjad',
    'totem' => 'abeille.jpg',
    'notes' => array())
);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1><?php echo $title ?></h1>
    <h2>Liste des stagiaires</h2>
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Totem</th>
        <th>Notes</th>
      </tr>
      <?php
      foreach($stagiaires as $s) {
        echo '<tr>';
        echo '<td>' . majusculeInitiale($s['prenom']) . '</td>';
        echo '<td>' . majusculeInitiale($s['nom']) . '</td>';
        echo '<td><img src="img/totems/' . $s['totem'] . '" alt=""/></td>';
        //echo '<td>' . $s['notes'][sizeof($s['notes']) - 1] . '</td>';
        echo '<td>' . derniereNote($s['notes']) . '</td>';
        echo '</tr>';
      }
      ?>
    </table>

  </body>
</html>
