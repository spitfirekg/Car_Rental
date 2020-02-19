<?php require 'includes/header.php'; ?>

<?php
  //Konekcija sa bazom podataka
  require 'config/dbConnect.php';
  //Ukoliko kliknemo na taster OBRISI
  if(isset($_SESSION['username'])){
  if(isset($_POST['delete'])){
    $sql = "DELETE FROM korisnici WHERE username='$_SESSION[username]'";
    $result = mysqli_query($conn,$sql);
    session_unset();
    session_destroy();
    header("Location:register.php");
    }
  }
 ?>


<div class="container" style="padding-top:2%;padding-bottom:2%;">

  <h1 class="login-header" style="width:80%;margin-left:10%;"><?php echo $_SESSION['username'] ?> zelite li da obrisete svoj profil ?</h1>

  <form action="delete.profile.php" method="post">
    <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
    <input type="submit" name="delete" value="OBRISI" class="admin-table-btn-del">

  </form>

</div>

<?php require 'includes/footer.php'; ?>
