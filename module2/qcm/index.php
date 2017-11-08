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

  $questions = $qcm->generate(); // retourne un tableau
  // d'objets Question

  // echo '<pre>';
  // print_r($questions);
  // echo '</pre>';
}

if (isset($_POST['validate'])) {
  var_dump($_POST);
}

?>

<h3>Génération d'un QCM</h3>
<!-- filtres -->
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

<?php
  if (isset($qcm) && $questions == false) {
    echo '<div class="alert alert-warning">';
    echo 'Aucune question ne correspond aux critères de recherche';
    echo '</div>';
  }
?>


<?php if (isset($qcm) && $questions != false): ?>
  <form method="POST">
  <?php foreach($questions as $question): ?>
    <div>
      <h4><?= $question->getTitle(); ?></h4>
      <?php foreach($question->getAnswers() as $answer): ?>
        <div>
          <input
            name="<?= $question->getId() ?>[]"
            value="<?= $answer->getId()?>"
            type="checkbox">
          <?= $answer->getBody(); ?>
        </div>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>
    <input type="hidden" name="category" value="<?=$qcm->getCategory()?>">
    <input type="hidden" name="level" value="<?=$qcm->getLevel()?>">
    <input type="hidden" name="nb_questions" value="<?=$qcm->getNbQuestions()?>">
    <input type="submit" name="validate" value="Valider">
  </form>
<?php endif ?>
