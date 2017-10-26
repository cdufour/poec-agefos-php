<?php
include('header.php');

//print_r($_GET); // affiche le contenu du tableau associatif $_GET
$nom = $_GET['nom'];

?>

<!--votre code ici-->
<h2>Infos concernant <?php echo $nom ?></h2>

<?php
include('footer.php');
?>
