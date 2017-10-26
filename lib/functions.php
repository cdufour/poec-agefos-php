<?php
define('AUCUNE_NOTE_MSG', 'Aucune note');
define('ERROR_COLOR', '#FF6633');
define('ERROR_CLASS', 'echec');

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
    return AUCUNE_NOTE_MSG;
  } else {
    return $notes[$nb_notes - 1];
  }
}

function moyenne($notes, $precision) {
  $nb_notes = sizeof($notes);

  if ($nb_notes == 0) return AUCUNE_NOTE_MSG;
  if ($nb_notes == 1) return $notes[0];

  $somme = 0;
  foreach($notes as $note) {
    $somme += $note; // équivalent à $somme = $somme + $note
  }
  return round($somme / $nb_notes, $precision);
}

// variante syntaxique, même résultat
// function moyenne($notes, $precision) {
//   $nb_notes = sizeof($notes);
//
//   if ($nb_notes == 0) {
//     return AUCUNE_NOTE_MSG;
//   } elseif($nb_notes == 1) {
//     return $notes[0];
//   } else {
//     $somme = 0;
//     foreach($notes as $note) {
//       $somme += $note; // équivalent à $somme = $somme + $note
//     }
//     return round($somme / $nb_notes, $precision);
//   }
// }


?>
