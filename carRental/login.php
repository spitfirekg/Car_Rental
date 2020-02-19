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
        $sql = "SELECT * FROM korisnici WHERE username = '$username' and password= '$password'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 1){
          $_SESSION['username'] = $username;
          header("Location:user.panel.php");
          mysqli_close($conn);
        }else{
          array_push($errors,"Netacno username ili password");
        }
      }

    }
 ?>

<div class="container">
  <?php if(!isset($_SESSION['username'])) :?>
    <div class="login">
      <form  action="login.php" method="post">
        <?php require 'errors.php'; ?>
        <h1 class="login-header">Login Korisnika</h1>
        <input type="text" name="username" placeholder="USERNAME" class="login-input" style="box-shadow:0px 0px 10px #58728C;">
        <input type="password" name="password" placeholder="PASSWORD" class="login-input" style="box-shadow:0px 0px 10px #58728C;"><br>
        <input type="submit" name="login" value="Login" class="login-btn">

      </form>

    </div>
  <?php endif ?>
  <?php if(isset($_SESSION['username'])){
      header("Location.user.panel.php");
  }
  ?>

</div>

<?php require 'includes/footer.php'; ?>
