<?php include('header.php'); ?>

<h2>Contact</h2>

<div class="col-md-9">

  <form action="form.php" method="POST">
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

</div>
<div class="col-md-3">
  <?php include('sidebar.php'); ?>
</div>


<?php include('footer.php'); ?>
