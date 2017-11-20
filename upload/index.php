<?php
//var_dump($_POST);
var_dump($_FILES);
/*
$_FILES: tableau de tableaux associatif. Chaque tableau associatif
 représente un fichier "uploaded" contenant les clés suivantes:
 - name
 - type
 - tmp_name
 - error
 - size
 */

$dir_upload = 'images_uploaded/';

// N.B: changer les permissions pour autoriser le déplacement

if (isset($_POST['submit'])) {
  // formulaire envoyé

  // To do: vérifier type et size avant le déplacement

  $result = move_uploaded_file($_FILES['file']['tmp_name'],
    $dir_upload . $_FILES['file']['name'] );

  ($result)
   ? print("Le téléchargement a réussi")
   : print("Le téléchargement a échoué");
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Upload</title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit" name="submit" value="Envoyer les données">
    </form>
  </body>
</html>
