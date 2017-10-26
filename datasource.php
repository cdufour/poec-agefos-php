<?php

function listeStagiaires() {

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
      'notes' => array(4,5,10)),
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

  return $stagiaires;
}

?>
