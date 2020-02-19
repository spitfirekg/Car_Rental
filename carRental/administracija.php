<?php require 'includes/header.php'; ?>

<?php
    require 'config/dbConnect.php';
    $errors=array();

    //Ukoliko kliknemo taster za login
    if(isset($_POST['login'])){
      //Prihvatiti podatke unete u formu i spreciti injecovanje u bazu
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);

      //Ukoliko su polja za unis prazna
      if(empty($username)){array_push($errors,"Niste uneli username ");}
      if(empty($password)){array_push($errors,"Niste uneli password ");}

      //Ukoliko greske ne postoje nastaviti sa loginon korisnika
      if(count($errors) == 0){
        $password = md5($password);
        $sql = "SELECT * FROM admin WHERE userAdmin = '$username' and passAdmin= '$password'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1){
          $_SESSION['admin'] = $username;
          header("Location:admin.panel.php");
          mysqli_close($conn);
        }else{
          array_push($errors,"Netacno username ili password");
        }
      }

    }
 ?>

 <?php if(isset($_SESSION['admin'])){
   header("Location:admin.panel.php");

 }
 ?>



<div class="container">

  <div class="container-admin-content">

    <div class="login">
      <h1 class="login-header">Login administratora</h1>
      <form action="administracija.php" method="post">
        <?php require 'errors.php'; ?>
        <input type="text" name="username" placeholder="USERNAME" class="login-input">
        <input type="password" name="password" placeholder="PASSWORD" class="login-input">
        <input type="submit" name="login" value="LOGIN" class="login-input-btn" style="margin-left:33%;">

      </form>

    </div>

  </div>

</div>

<?php require 'includes/footer.php'; ?>
