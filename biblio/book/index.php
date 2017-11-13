<?php
include_once('./author/Author.php');
include_once('./author/AuthorManager.php');

include_once('./book/Book.php');
include_once('./book/BookManager.php');

$author_manager = new AuthorManager($db); // gestionnaire d'auteurs
$authors = $author_manager->list();
$book_manager = new BookManager($db); // gestionnaire de livres

if (isset($_POST['submit'])) {
  // créer on objet de type de Book
  $book = new Book(
    $_POST['title'],
    $_POST['isbn'],
    intval($_POST['nb_pages'])
  );

  // à partir d'un identifiant d'auteur, je souhaite
  // obtenir un objet Author complet
  $author = $author_manager->getById(intval($_POST['author']));
  $book->setAuthor($author);

  // variante possible: au lieu de reconstituer un objet Author complet
  // à partir d'un identifiant, on aurait pu traiter la propriété
  // author de l'objet $book en tant qu'integer

  // fournir l'objet $book au BookManager
   if($book_manager->save($book) == 0)
    echo 'L\'Enregistrement du livre a échoué';
}

?>
<h2>Livres</h2>

<!-- formulaire d'ajout -->
<form method="POST" class="form-inline">

  <div class="form-group">
    <input type="text" name="title" placeholder="Titre">
  </div>

  <div class="form-group">
    <input type="text" name="isbn" placehold$_POSTer="ISBN">
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
