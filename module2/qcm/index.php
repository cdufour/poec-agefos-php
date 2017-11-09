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
  //var_dump($_POST);
  // on reconstitue l'objet $qcm "perdu" en raison de la nouvelle
  // requête HTTP
  $qcm = new QCM(
    $db,
    $_POST['category'],
    $_POST['level'],
    $_POST['nb_questions']
  );

  $questions = $qcm->generate(); // génération du formulaire
  $results = $qcm->processChoices($_POST); // traitement des choix client
  echo '<p>Vous avez obtenu <b>' . $results . '</b> bonne(s) réponse(s)</p>';
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
          <!--
          donner à l'attribut html value un nom avec crochets
          exemple: test[] permet d'associer à ce nom un tableau de valeurs
          sans crochet (exemple: test), si plusieurs input partage un nom,
          le dernier input cochée/sélectionnée/etc écrase la valeur précédente
          Les valeurs multiples sont automiquement gérées par PHP qui les insére
          dans la super-globale POST
         -->
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
