<?php

if (isset($_GET['id_question'])) {
  $id_question = $_GET['id_question'];

  $query = $db->prepare(
    ' SELECT title
      FROM question
      WHERE id = :id_question
    ');
  $query->execute(array(
    ':id_question' => intval($id_question)
  ));
  $title = $query->fetch(PDO::FETCH_OBJ)->title;
}

if (isset($_POST['submit'])) {
  // formulaire d'ajout d'une réponse envoyé
  // Enregistrement en DB
  $correct = 0;
  if (isset($_POST['correct'])) $correct = 1;

  $query = $db->prepare(
    ' INSERT INTO answer (body, correct, id_question)
      VALUES (:body, :correct, :id_question)
    ');
  $query->execute(array(
    ':body' => $_POST['body'],
    ':correct' => $correct,
    ':id_question' => intval($_POST['id_question'])
  ));
}

?>

<h2>Question: <?=$title ?></h2>
<h3>Ajouter une réponse</h3>
<form method="POST">
  <div class="form-group">
    <label for="body">Texte</label>
    <textarea name="body"></textarea>
  </div>
  <div class="form-group">
    <label for="correct">Bonne réponse</label>
    <input type="checkbox" name="correct"/>
  </div>
  <input type="hidden" name="id_question" value="<?=$id_question?>">
  <input type="submit" name="submit" value="Enregistrer">
</form>
