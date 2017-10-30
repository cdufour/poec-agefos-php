<?php
include('lib/functions.php');
include('datasource.php');
include('header.php');
//print_r($_GET); // affiche le contenu du tableau associatif $_GET

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stagiaire = stagiaireParId($id);
  //var_dump($stagiaire); // var_dump affiche infos détaillées sur la variable

  if ($stagiaire) { // si stagiaire n'est ni NULL, ni false, ni chaîne vide
    echo afficheStagiaireDetails($stagiaire); // génére le balisage html
  } else {
    echo 'Stagiaire non trouvé';
  }

} else {
  echo 'Paramètre id manquant';
}

?>

<?php include('footer.php'); ?>
