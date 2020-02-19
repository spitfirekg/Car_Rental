<?php require 'includes/header.php'; ?>

<?php
    $errors = array();
    //Konekcija sa bazom podataka
    require 'config/dbConnect.php';
    //Ukoliko kliknemo na taster za registraciju
    if(isset($_POST['register'])){
      //Prihvatiti sve podatke koji su uneti u formu
      $username = mysqli_real_escape_string($conn,$_POST['adminUsername']);
      $password = mysqli_real_escape_string($conn,$_POST['adminPassword']);

      //Ukoliko su polja za unos prazna
      if(empty($username)){array_push($errors,"Niste uneli username !");}
      if(empty($password)){array_push($errors,"Niste uneli password !");}

      //Ukoliko nema gresaka pri unosu
      if(count($errors) == 0){
        $password = md5($password);
        $sql = "INSERT INTO admin (userAdmin,passAdmin) VALUES ('$username','$password')";
        mysqli_query($conn,$sql);
        $_SESSION['admin'] = $username;
        header("Location:administracija.php");
      }

    }

    $query = "SELECT * FROM admin ORDER BY id ASC";
    $query_result = mysqli_query($conn,$query);
 ?>

<div class="container" style="padding-top:2%;padding-bottom:2%;margin-bottom:5%;">

<?php if(isset($_SESSION['admin'])): ?>

  <h1 class="login-header" style="width:50%;margin-left:25%;">Dodajte novog administratora</h1>

  <?php if(isset($_SESSION['admin'])): ?>
    <form class="" action="admin.php" method="post">
     <?php require 'errors.php'; ?>

    <input type="text" name="adminUsername" placeholder="Admin Username" style="width:20%;margin-left:40%;text-align:center;"><br>
    <input type="password" name="adminPassword" placeholder="Admin Password" style="width:20%;margin-left:40%;margin-top:1%;text-align:center;"><br>
    <input type="submit" name="register" value="Registruj administratora" style="width:15%;margin-left:43%;margin-top:1%;">
    </form>
  <?php endif ?>

  <?php if(!isset($_SESSION['admin'])): ?>
    <h3 class="login-header" style="width:90%;margin-left:5%;">Da biste dodali novog administratora morate biti prijavljeni administrator !</h3>
  <?php endif ?>


  <hr width=80%>
  <?php if(isset($_SESSION['admin'])): ?>
  <h2 class="login-header" style="width:40%;margin-left:30%;">Lista aktivnih adminitratora</h2>
  <table style="width:20%;margin-left:40%;">
    <tr>
      <th>Id</th>
      <th>Username</th>
    </tr>
    <?php while($query_row = mysqli_fetch_assoc($query_result)): ?>
      <tr class="user-data-table">
        <td><?php echo $query_row['id'] ?></td>
        <td><?php echo $query_row['userAdmin'] ?></td>
      </tr>
    <?php endwhile ?>
  </table>
<?php endif ?>

<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>
</div>

<?php require 'includes/footer.php'; ?>
