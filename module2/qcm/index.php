<?php
include ('./categories.php');
include ('./levels.php'); // fournit $levels
include ('QCM.php'); // inclusion de la classe QCM

$categories = getCategories($db);

if (isset($_POST['submit'])) {

  $qcm = new QCM(
    $db,
    $_POST['category'],
    $_POST['level'],
    $_POST['nb_questions']
  );

  $questions = $qcm->generate();
  echo '<pre>';
  print_r($questions);
  echo '</pre>';

}
?>

<h3>Génération d'un QCM</h3>
<form class="form-inline well" method="POST">

  <div class="form-group">
    <select name="category">
      <option value="0">Choisir une catégorie</option>
      <?php foreach($categories as $category): ?>
        <option value="<?=$category->id ?>"><?=$category->name ?></option>
      <?php endforeach ?>
    </select>
  </div>

  <div class="form-group">
    <select name="level">
      <option value="0">Choisir un niveau de difficulé</option>
      <?php foreach($levels as $key => $level): ?>
        <option value="<?=$key ?>"><?=$level ?></option>
      <?php endforeach ?>
    </select>
  </div>

  <div class="form-group">
    <label for="nb_questions">Nombre max de questions</label>
    <input type="number" name="nb_questions">
  </div>

  <input type="submit" name="submit" value="Générer">

</form>
