<?php require 'includes/header.php'; ?>

<?php
    //Ukoliko kliknemo na taster korisnici
    if(isset($_POST['korisnici'])){
      header("Location:korisnici.admin.php");
    }
    if(isset($_POST['vozila'])){
      header("Location:vozila.admin.php");
    }
    if(isset($_POST['administracija'])){
      header("Location:admin.php");
    }
 ?>

<div class="container" style="padding-bottom:2%;padding-top:2%;">
  <?php if(isset($_SESSION['admin'])): ?>
  <div class="container-admin-content">
<form class="" action="admin.panel.php" method="post">


    <input type="submit" name="korisnici" value="KORISNICI" class="admin-panel-btn">
    <input type="submit" name="vozila" value="VOZILA" class="admin-panel-btn">
    <input type="submit" name="administracija" value="ADMIN" class="admin-panel-btn">
    <h1 class="login-header" style="width:50%;margin-left:25%;"><a href="reservation.list.php">Lista rezervacija</a></h1>
    </form>

  </div>

<?php endif ?>
<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>
</div>

<?php require 'includes/footer.php'; ?>
