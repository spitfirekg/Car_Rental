<?php require 'includes/header.php'; ?>

<?php
  $errors=array();
  //Konektovanje sa bazom podataka
  require 'config/dbConnect.php';
  //Ukoliko kliknemo na taster registracija
  if(isset($_POST['register'])){
    //Prihvati sve podatke koji su uneti u formu i spreci injectovanje u bazu
    $ime = mysqli_real_escape_string($conn,$_POST['ime']);
    $prezime = mysqli_real_escape_string($conn,$_POST['prezime']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $telefon = mysqli_real_escape_string($conn,$_POST['telefon']);
    $grad = mysqli_real_escape_string($conn,$_POST['grad']);
    $adresa = mysqli_real_escape_string($conn,$_POST['adresa']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password1 = mysqli_real_escape_string($conn,$_POST['password1']);
    $password2 = mysqli_real_escape_string($conn,$_POST['password2']);

    //Ukoliko polja nisu popunjena prikazati greske
    if(empty($ime)){array_push($errors,"Niste uneli ime");}
    if(empty($prezime)){array_push($errors,"Niste uneli prezime");}
    if(empty($email)){array_push($errors,"Niste uneli email");}
    if(empty($telefon)){array_push($errors,"Niste uneli telefon");}
    if(empty($grad)){array_push($errors,"Niste uneli grad");}
    if(empty($adresa)){array_push($errors,"Niste uneli adresa");}
    if(empty($username)){array_push($errors,"Niste uneli username");}
    if(empty($password1)){array_push($errors,"Niste uneli password");}

    //Ukoliko dva passworda nisu identicna
    if($password1 != $password2){array_push($errors,"Dva password-a nisu ista");}

    //Ovaj sql upit treba da prover idali korisnik sa istim emailom i usernameom vec postoji
    $check_user = "SELECT * FROM korisnici WHERE username = '$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn,$check_user);
    $user = mysqli_fetch_assoc($result);

    //Ukoliko postoji Korisnik izbaciti obavestenje
    if($user['username'] === $username){array_push($errors,"Username je vec zauzet");}
    if($user['email'] === $email){array_push($errors,"Email je vec zauzet");}

    //Ukoliko ne postoje greske nastaviti sa procesom registracije
    if(count($errors) == 0){
      $password = md5($password1);
      $sql = "INSERT INTO korisnici (ime,prezime,email,telefon,grad,adresa,username,password)
              VALUES ('$ime','$prezime','$email','$telefon','$grad','$adresa','$username','$password')";
      mysqli_query($conn,$sql);
      $_SESSION['username']=$username;
      header("Location:user.panel.php");
      mysqli_close($conn);
    }

  }
 ?>

<div class="container">


  <div class="login">
    <form action="register.php" method="post">
      <?php require 'errors.php'; ?>
      <h1 class="login-header">Registracija Korisnika</h1>
      <input type="text" name="ime" placeholder="IME" class="login-input">
      <input type="text" name="prezime" placeholder="PREZIME" class="login-input"><br>
      <input type="email" name="email" placeholder="E-MAIL ADRESA" class="login-input">
      <input type="text" name="telefon" placeholder="KONTAKT TELEFON" class="login-input"><br>
      <input type="text" name="grad" placeholder="GRAD" class="login-input">
      <input type="text" name="adresa" placeholder="ADRESA" class="login-input"><br>
      <input type="text" name="username" placeholder="USERNAME" class="login-input" style="box-shadow:0px 0px 10px #58728C;"><br>
      <input type="password" name="password1" placeholder="PASSWORD" class="login-input" style="box-shadow:0px 0px 10px #58728C;"><br>
      <input type="password" name="password2" placeholder="POTVRDITE PASSWORD" class="login-input" style="box-shadow:0px 0px 10px #58728C;">
      <input type="submit" name="register" value="Registracija" class="login-input-btn">


    </form>

  </div>


</div>

<?php require 'includes/footer.php'; ?>
