<?php

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == 'root' && $password == 'paris') {
    $_SESSION['admin'] = $username;
    header('location:?route=question/list');
  } else {
    echo '<p class="alert alert-danger">L\'identification a échoué</p>';
  }
}

?>

<h3>Log In</h3>
<form method="POST">
  <div class="form-group">
    <input name="username" type="text" placeholder="Nom d'utilisateur" required>
  </div>
  <div class="form-group">
    <input name="password" type="password" placeholder="Mot de passe" required>
  </div>
  <input type="submit" name="submit" value="Connexion">
</form>
