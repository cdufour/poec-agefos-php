<?php include('header.php'); ?>

<h2>Contact</h2>

<form style="width:73%; float:left" action="form.php" method="POST">
  <div class="form-group">
    <label for="objet">Objet</label>
    <input class="form-control" type="text" name="objet" />
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" name="message"></textarea>
  </div>

  <input type="submit" value="Valider">
</form>

<div style="width:25%; margin:3px; float:left; padding:10; border:1px #777 solid">
  <h4>Meilleurs stagiaires</h4>
  <p style="font-size:1.5em; color:green">Stagiaire X (19,5)</p>
  <p>Stagiaire Y (17)</p>
  <p>Stagiaire X (16,2)</p>
</div>


<?php include('footer.php'); ?>
