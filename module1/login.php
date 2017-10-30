<?php
include('datasource.php');
include('lib/functions.php');
include('header.php');

//print_r($_SERVER);
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {

  if ($_POST['nom'] == "") {
    echo '<p class="danger">Prière d\'indiquer un nom</p>';
  }

  if (verifieIdentite($_POST, listeStagiaires())) {
    echo 'Bonjour ' . $_POST['nom'];
  } else {
    echo 'stagiaire inconnu';
  }
}

?>
<h2>Login</h2>

<form method="post">
  <div class="form-group">
    <label for="">Nom</label>
    <input class="form-control" type="text" name="nom" required>
  </div>
  <div class="form-group">
    <label for="">Mot de passe</label>
    <input class="form-control" type="password" name="password">
  </div>
  <input class="btn btn-primary" type="submit" value="Valider">
</form>

<?php include('footer.php')?>
