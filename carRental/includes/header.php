<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rent a Car System</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>

    <div class="header">
      <h1><a href="index.php" class="header-main-text" style="text-decoration:none;">AUTO STAR</a></h1>
      <img src="images/logo.png" alt="logo" class="header-logo">


      <?php
      session_start();
        if(!isset($_SESSION['username'])){
          echo "<div class='header-links'>";
          echo "<a href='register.php' class='login-link'>Registracija</a>";
          echo "<a href='login.php' class='login-link'>Login</a>";
          echo "<a href='vozila.php' class='login-link'>VOZILA</a>";
          echo "<a href='index.php' class='login-link'>POCETNA</a>";
          echo "</div>";
        }
        if(isset($_SESSION['username'])){
          echo "<div class='header-links'>";
          echo "<a href='logout.php' class='login-link'>Logout</a>";
          echo "<a href='user.panel.php' class='login-link'>Korisnicki panel</a>";
          echo "<a href='vozila.php' class='login-link'>VOZILA</a>";
          echo "</div>";
        }
       ?>


    </div>
