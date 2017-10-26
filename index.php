<?php
$title = "Formation PHP";

$stagiaires = array(
  array(
    'nom' => 'abecassis',
    'prenom' => 'stéphane',
    'totem' => 'abeille.jpg'),
  array(
    'nom' => 'chauvet',
    'prenom' => 'stevens',
    'totem' => 'paresseux.jpg'),
  array(
    'nom' => 'grivel',
    'prenom' => 'sébastien',
    'totem' => 'tigre.jpg'),
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
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Totem</th>
      </tr>
      <?php
      foreach($stagiaires as $s) {
        echo '<tr>';
        echo '<td>' . $s['prenom'] . '</td>';
        echo '<td>' . $s['nom'] . '</td>';
        echo '<td><img src="img/totems/' . $s['totem'] . '" alt=""/></td>';
        echo '</tr>';
      }
      ?>
    </table>

  </body>
</html>
