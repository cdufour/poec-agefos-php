<?php
include_once('./lib/functions.php');
include_once('datasource.php');

//var_dump(meilleurStagiaire(listeStagiaires()));
$meilleurs = meilleursStagiaires(listeStagiaires(), 3);
?>

<ul>
  <?php
    foreach ($meilleurs as $m) {
      echo '<li>' . $m['stagiaire']['nom'] . ' ('.$m['moyenne'].')</li>';
    }
  ?>
</ul>
