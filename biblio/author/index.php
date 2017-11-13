<?php
include_once('./author/Author.php');
include_once('./author/AuthorManager.php');

// objet permettant les opérations en BD
$author_manager = new AuthorManager($db);

// ajout d'un auteur
if (isset($_POST['submit'])) {
  // création d'un objet Author à partir des données postées
  $author = new Author(
    $_POST['firstname'],
    $_POST['lastname'],
    intval($_POST['birth_year']),
    $_POST['country']
  );

  // on fournit l'objet $author au manager pour des opération en BD
  // et on teste le cas échec (== 0)
  if($author_manager->save($author) == 0)
    echo 'Echec de l\'enregistrement';
}

// actions sur auteur
if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $author_id = intval($_GET['id']);

  // suppression
  if ($action == 'delete') {
    if ($author_manager->deleteById($author_id) == 0)
      echo 'La suppression a échoué';
  }
}

$authors = $author_manager->list();
?>
<h2>Auteurs</h2>

<!-- formulaire d'ajout -->
<form method="POST" class="form-inline">

  <div class="form-group">
    <input type="text" name="firstname" placeholder="Prénom">
  </div>

  <div class="form-group">
    <input type="text" name="lastname" placeholder="Nom">
  </div>

  <div class="form-group">
    <label for="birth_year">Année de naissance</label>
    <input type="number" name="birth_year" placeholder="1950">
  </div>

  <div class="form-group">
    <input type="text" name="country" placeholder="Pays">
  </div>

  <input type="submit" name="submit" value="Enregistrer">

</form>

<!-- liste des auteurs -->
<table class="table table-striped table-bordered">
  <tr>
    <th>Prénom</th>
    <th>Nom</th>
    <th>Année de naissance</th>
    <th>Pays</th>
    <th>Actions</th>
  </tr>
  <?php foreach($authors as $author): ?>
    <tr>
      <td><?= $author->getFirstname() ?></td>
      <td><?= $author->getLastname() ?></td>
      <td><?= $author->getBirthYear() ?></td>
      <td><?= $author->getCountry() ?></td>
      <td>
        <a
          class="btn btn-danger btn-xs"
          href="?route=authors&action=delete&id=<?= $author->getId() ?>">
          Supprimer</a>
      </td>
    </tr>
  <?php endforeach ?>
</table>
