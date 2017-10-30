<?php
include_once('../datasource.php');

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

function afficheStagiaireDetails($stagiaire) {
  $output = '';
  $output .= '<div class="stagiaire">';
  $output .= '<h2>'.$stagiaire['nom'].'</h2>';
  $output .= '<img src="'.ASSETS_PATH.'img/totems/' . $stagiaire['totem'] . '" alt=""/>';
  $output .= '</div>';

  return $output;
}

function meilleurStagiaire($stagiaires) {
  // @in: tableau des stagiaires
  // @out: stagiaire ayant la meilleure moyenne + moyenne + indice
  $meilleurMoyenne = moyenne($stagiaires[0]['notes'], 2); // le premier par défaut
  $meilleurStagiaire = NULL;
  $indice = NULL;

  $i = 0;
  foreach($stagiaires as $s) {
    if (moyenne($s['notes'], 2) > $meilleurMoyenne) {
      $meilleurMoyenne = moyenne($s['notes'], 2);
      $meilleurStagiaire = $s;
      $indice = $i;
    }
    $i++;
  }
  return array(
    'stagiaire' => $meilleurStagiaire,
    'moyenne' => $meilleurMoyenne,
    'indice' => $indice
  );

}

function meilleursStagiaires($stagiaires, $limit) {
  // @In stagiaires: source de données
  // @In limit: nombre de stagiaires à renvoyer
  // @out: tableau de stagiaires + moyennes
  $i = 0;
  $meilleursStagiaires = array();
  while ($i < $limit) {
    $meilleur = meilleurStagiaire($stagiaires);
    array_push($meilleursStagiaires, $meilleur);
    array_splice($stagiaires, $meilleur['indice'], 1);
    $i++;
  }

  return $meilleursStagiaires;
}

function verifieIdentite($info, $stagiaires) {
  // @In info: superglobale $_POST
  // @In stagiaires: source de données dans laquelle on recherche
  // @Out bool (true ou false)
  $found = false;
  foreach($stagiaires as $s) {
    if (($s['nom'] == $info['nom']) && ($s['password'] == $info['password'])) {
      $found = true;
      break;
    }
  }
  return $found;
}

?>
