<?php require 'includes/header.php'; ?>

<?php
$errors=array();
  //Konekcija sa bazom podataka
  require 'config/dbConnect.php';
  $query = "SELECT * FROM korisnici WHERE username = '$_SESSION[username]'";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($result)){
    $email = $row['email'];
    $telefon = $row['telefon'];
    $username = $row['username'];
    $password = $row['password'];
    $grad = $row['grad'];
    $adresa = $row['adresa'];
  }

  //UPDATE KORISNICKIH PODATAKA
  //Ukoliko kliknemo na taster Izmeni
  if(isset($_POST['update'])){
    //Prihvatiti podatke koji su uneti u formu
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $telefon = mysqli_real_escape_string($conn,$_POST['telefon']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $grad = mysqli_real_escape_string($conn,$_POST['grad']);
    $adresa = mysqli_real_escape_string($conn,$_POST['adresa']);

    //Ukoliko polja za unos podataka nisu popunjena
    if(empty($email)){array_push($errors,"Niste uneli email");}
    if(empty($telefon)){array_push($errors,"Niste uneli telefon");}
    if(empty($username)){array_push($errors,"Niste uneli username");}
    if(empty($grad)){array_push($errors,"Niste uneli grad");}
    if(empty($adresa)){array_push($errors,"Niste uneli adresu");}

    //Ukoliko greske sa unosom ne postoje - nastavit isa izmenom podataka
    if(count($errors) == 0){
      //$password=md5($password);
      $sql = "UPDATE korisnici SET email='$email',telefon='$telefon',username='$username',
                     grad='$grad',adresa='$adresa' WHERE username ='$_SESSION[username]'";
      mysqli_query($conn,$sql);
      $_SESSION['username']=$username;
      mysqli_close($conn);

      header("Refresh:1;url=user.data.php");
    }

  }
 ?>



<div class="container" style="padding-top:1%;">

  <div class="user-data">
    <form action="user.data.php" method="post">

      <?php require 'errors.php'; ?>


    <h1 class="login-header" style="width:60%;margin-left:20%;
                                    margin-bottom:2%;font-family: 'Roboto', sans-serif;">Vasi podaci</h1>
    <input type="email" name="email" value="<?php echo $email ?>" class="user-data-input"><br>
    <input type="text" name="telefon" value="<?php echo $telefon ?>" class="user-data-input"><br>
    <input type="text" name="username" value="<?php echo $username ?>" class="user-data-input"><br>
    <input type="text" name="grad" value="<?php echo $grad ?>" class="user-data-input"><br>
    <input type="text" name="adresa" value="<?php echo $adresa ?>" class="user-data-input"><br>
    <input type="submit" name="update" value="Izmeni podatke" class="login-btn">

    </form>

  </div>

</div>

<?php require 'includes/footer.php'; ?>
