<?php

function majusculeInitiale($str) {
  // dans la version actuelle, les caractères accentués
  // ne sont pas convertis en majuscule

  $initiale = $str[0]; // équivalent à substr($str, 0, 1);
  $reste = substr($str, 1);
  $initialeMajus = strtoupper($initiale);
  $resteMinus = strtolower($reste);

  return $initialeMajus . $resteMinus;
}

function derniereNote($notes) {
  // renvoie la dernière note si le tableau $notes n'est pas vide
  // renvoie "aucune note" si le tableau $notes est vide

  $nb_notes = sizeof($notes);

  if ($nb_notes == 0) {
    return "aucune note";
  } else {
    return $notes[$nb_notes - 1];
  }
}


?>
