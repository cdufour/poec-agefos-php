<?php

function listeStagiaires() {

  $stagiaires = array(
    array(
      'id' => 1,
      'nom' => 'abecassis',
      'prenom' => 'stéPHane',
      'totem' => 'abeille.jpg',
      'notes' => array(8,12,18)),
    array(
      'id' => 2,
      'nom' => 'chauvet',
      'prenom' => 'stevens',
      'totem' => 'paresseux.jpg',
      'notes' => array(4,5,10)),
    array(
      'id' => 3,
      'nom' => 'grivel',
      'prenom' => 'sébastien',
      'totem' => 'tigre.jpg',
      'notes' => array(14,14,14,18)),
    array(
      'id' => 4,
      'nom' => 'jafari',
      'prenom' => 'sajjad',
      'totem' => 'abeille.jpg',
      'notes' => array())
  );

  return $stagiaires;
}

function stagiaireParId($id) {
  //@ IN integer
  //@ OUT array || NULL
  $stagiaire = NULL;
  foreach(listeStagiaires() as $s) {
    if ($s['id'] == $id) {
      $stagiaire = $s;
      break; // sortie de boucle si l'id est trouvé
    }
  }
  return $stagiaire;
}

?>
