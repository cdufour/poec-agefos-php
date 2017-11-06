<?php
include('./categories.php'); // fournit getCategories()
define('URL_BASE', '?route=category/manage');
$action = NULL;

function getCategoryName($categories, $id) {
  // renvoie un chaîne de caractères
  $category_name = NULL;
  foreach($categories as $c) {
    if($c->id == $id) {
      $category_name = $c->name;
      break; // réponse trouvée => sortie de boucle
    }
  }
  return $category_name;
}

// récupération de la liste des catégories
$categories = getCategories($db);

// Enregistrement d'une catégorie
if (isset($_POST['insert'])) {

  // validation des données
  // trim supprime les espaces en début et fin de chaîne
  // strlen renvoie la longeur de la chaîne
  if (strlen(trim($_POST['name'])) < 3) {
    echo 'Le nom de la catégorie doit comporter au moins 3 caractères';
  } else {
    // condition remplie => enregisrement en DB possible
    $query = $db->prepare(
      ' INSERT INTO category (name)
        VALUES (:name)
      ');
    $result = $query->execute(array(
      ':name' => $_POST['name']
    ));

    // si succès => redirection
    // si échec =>  affichage d'un message
    ($result)
      ? header('location:' . URL_BASE)
      : print('L\'enregistrement de la catégorie a échoué');
  }

}

// Mise à jour d'une catégorie
if (isset($_POST['edit'])) {
  // validation des données
  if (strlen(trim($_POST['name'])) < 3) {
    echo 'Le nom de la catégorie doit comporter au moins 3 caractères';
  } else {
    // condition remplie => enregisrement en DB possible
    $query = $db->prepare(
      ' UPDATE category
        SET name = :name
        WHERE id = :id
      ');
    $result = $query->execute(array(
      ':name' => $_POST['name'],
      ':id' => $_POST['id']
    ));

    // si succès => redirection
    // si échec =>  affichage d'un message
    ($result)
      ? header('location:' . URL_BASE)
      : print('La mise à jour de la catégorie a échoué');
    }
  }
// Suppression d'une catégorie
if (isset($_GET['action']) && isset($_GET['id_category'])) {

  $action = $_GET['action'];
  $id_category = intval($_GET['id_category']);

  if ($action == 'delete') {
    $query = $db->prepare('DELETE FROM category WHERE id = :id');
    $result = $query->execute(array(
      ':id' => $id_category
    ));
    ($result)
      ? header('location:' . URL_BASE)
      : print('La suppression de la catégoie a échoué');
  } elseif ($action == 'edit') {
    //
  } else {
    echo '<div class="alert alert-danger">Action non reconnue...</div>';
  }

}

?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <table class="table table-bordered table-striped">
        <?php foreach($categories as $category): ?>
          <tr>
            <td><?= $category->name ?></td>
            <td>
              <a class="btn btn-xs btn-default" $
                href="?route=category/manage&action=edit&id_category=<?=$category->id?>">
                Modifier</a>
              <a
                class="btn btn-xs btn-danger"
                href="?route=category/manage&action=delete&id_category=<?=$category->id?>">
                Supprimer</a>
            </td>
          </tr>
        <?php endforeach ?>
      </table>
    </div>
    <div class="col-md-4">

      <?php if($action == 'edit'): ?>
        <h3>Modifier la catégorie</h3>
        <form method="POST">
          <div class="form-group">
            <label for="name">Nom</label>
            <input
              type="text"
              name="name"
              required
              value="<?= getCategoryName($categories, $id_category) ?>">
          </div>
          <input type="hidden" name="id" value="<?=$id_category ?>">
          <input type="submit" name="edit" value="Mettre à jour">
        </form>
      <?php else: ?>
        <h3>Ajouter une catégorie</h3>
        <form method="POST">
          <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" required>
          </div>
          <input type="submit" name="insert" value="Enregistrer">
        </form>
      <?php endif ?>

    </div>
  </div>
</div>
