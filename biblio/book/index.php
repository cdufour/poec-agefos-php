<?php
include_once('./author/Author.php');
include_once('./author/AuthorManager.php');

include_once('./book/Book.php');
include_once('./book/BookManager.php');

$author_manager = new AuthorManager($db);
$authors = $author_manager->list();

if (isset($_POST['submit'])) {
  // créer on objet de type de Book
  $book = new Book(
    $_POST['title'],
    $_POST['isbn'],
    intval($_POST['nb_pages'])
  );

  // fournir cet objet au BookManager
}

?>
<h2>Livres</h2>

<!-- formulaire d'ajout -->
<form method="POST" class="form-inline">

  <div class="form-group">
    <input type="text" name="title" placeholder="Titre">
  </div>

  <div class="form-group">
    <input type="text" name="isbn" placeholder="ISBN">
  </div>

  <div class="form-group">
    <label for="nb_pages">Nombre de pages</label>
    <input type="number" name="nb_pages">
  </div>

  <div class="form-group">
    <select name="author">
      <option value="0">Sélectionner un auteur</option>
      <?php foreach($authors as $author): ?>
        <option value="<?= $author->getId() ?>"><?= $author->getLastname() ?></option>
      <?php endforeach ?>
    </select>
  </div>

  <input type="submit" name="submit" value="Enregistrer">

</form>
