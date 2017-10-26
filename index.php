<?php
include('lib/functions.php');
include('datasource.php');

$stagiaires = listeStagiaires();
?>

<?php include('header.php') ?>
    <h2>Liste des stagiaires</h2>
    <table>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Totem</th>
        <th>Dernière note</th>
        <th>Moyenne des notes</th>
      </tr>
      <?php
      foreach($stagiaires as $s) {
        $moyenne = moyenne($s['notes'], 2);

        echo '<tr>';
        echo '<td>' . majusculeInitiale($s['prenom']) . '</td>';
        echo '<td><a href="stagiaire_details.php?nom='.$s['nom'].'">' . majusculeInitiale($s['nom']) . '</a></td>';
        echo '<td><img src="img/totems/' . $s['totem'] . '" alt=""/></td>';
        //echo '<td>' . $s['notes'][sizeof($s['notes']) - 1] . '</td>';
        echo '<td>' . derniereNote($s['notes']) . '</td>';

        if ($moyenne < 10 && $moyenne != AUCUNE_NOTE_MSG) {
          //echo '<td style="color:'.ERROR_COLOR.'">' . $moyenne . '</td>';
          echo '<td class="'.ERROR_CLASS.'">' . $moyenne . '</td>';
        } else {
          echo '<td>' . $moyenne . '</td>';
        }

        echo '</tr>';
      }
      ?>
    </table>

<?php include('footer.php') ?>
