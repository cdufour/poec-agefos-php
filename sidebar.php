<?php
include_once('./lib/functions.php');
include_once('datasource.php');

//var_dump(meilleurStagiaire(listeStagiaires()));
$meilleurs = meilleursStagiaires(listeStagiaires(), 3);
?>

<ul>
  <?php
    $i = 0;
    foreach ($meilleurs as $m) {
      if ($i == 0) {
        echo '<li class="best">' . $m['stagiaire']['nom'] . ' ('.$m['moyenne'].')</li>';
      } else {
        echo '<li>' . $m['stagiaire']['nom'] . ' ('.$m['moyenne'].')</li>';
      }
      $i++;
    }
  ?>
</ul>
