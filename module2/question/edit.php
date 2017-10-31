<?php
include('categories.php'); // accès à la variable $categories

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = $db->prepare('SELECT * FROM question WHERE id = :id');
  $query->execute(array(
    ':id' => intval($id)
  ));
  $question = $query->fetch(PDO::FETCH_OBJ); // renvoie un objet
}
?>

<form style="width:30%" method="POST">

  <div class="form-group">
    <label>Intitulé</label>
    <input value="<?=$question->title ?>" type="text" class="form-control" name="title" required>
  </div>

  <div class="form-group">
    <select name="category">
      <option value="0">Choisir une catégorie</option>
      <?php foreach($categories as $category): ?>
        <?php if($question->category == $category): ?>
          <option selected><?= $category ?></option>
        <?php else: ?>
          <option><?= $category ?></option>
        <?php endif ?>
      <?php endforeach ?>
    </select>
  </div>

  <div class="form-group">
    <select name="level">
      <option value="0">Choisir un niveau de difficulté</option>
      <option value="1">Facile</option>
      <option value="2">Moyen</option>
      <option value="3">Difficile</option>
    </select>
  </div>

  <input type="submit" class="btn btn-primary" value="Mettre à jour" name="submit">

</form>
