<?php
// tableau des catégories
// $categories = array(
//   'Politique',
//   'Sport',
//   'Divers',
//   'Programmation',
//   'Littérature',
//   'Cuisine',
//   'Histoire',
//   'Cinéma'
// );

function getCategories($db) {
  // $db : objet PDO fournit en entrée
  $query = $db->prepare('SELECT * FROM category ORDER BY name ASC');
  $query->execute();
  $categories = $query->fetchAll(PDO::FETCH_OBJ);
  return $categories;
}

?>
