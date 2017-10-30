<?php

function listeStagiaires() {

  $stagiaires = array(
    array(
      'id' => 1,
      'nom' => 'abecassis',
      'prenom' => 'stéPHane',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(8,12,18)),
    array(
      'id' => 2,
      'nom' => 'chauvet',
      'prenom' => 'stevens',
      'password' => 123,
      'totem' => 'paresseux.jpg',
      'notes' => array(4,5,10)),
    array(
      'id' => 3,
      'nom' => 'grivel',
      'prenom' => 'sébastien',
      'password' => 123,
      'totem' => 'tigre.jpg',
      'notes' => array(14,14,14,18)),
    array(
      'id' => 4,
      'nom' => 'jafari',
      'prenom' => 'sajjad',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array()),
    array(
      'id' => 5,
      'nom' => 'jeannine',
      'prenom' => 'christiane',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(8, 9)),
    array(
      'id' => 6,
      'nom' => 'langlais',
      'prenom' => 'rémi',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(11, 13, 6)),
    array(
      'id' => 7,
      'nom' => 'messaoudi',
      'prenom' => 'abdel waheb',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(18, 17, 20)),
    array(
      'id' => 8,
      'nom' => 'moreau',
      'prenom' => 'xavier',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(5, 15)),
    array(
      'id' => 9,
      'nom' => 'nigatu',
      'prenom' => 'amare',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array()),
    array(
      'id' => 10,
      'nom' => 'orabi',
      'prenom' => 'rayane',
      'password' => 123,
      'totem' => 'abeille.jpg',
      'notes' => array(7, 9, 17)),
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
