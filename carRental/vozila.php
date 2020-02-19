<?php require 'includes/header.php'; ?>

<?php
  require 'config/dbConnect.php';

  //Dobijanje rezultata o vozilima iz baze podataka
  $sql = "SELECT * FROM vozila ORDER BY cena ASC";
  $result = mysqli_query($conn,$sql);
 ?>

<div class="container" style="padding-top:1%;margin-bottom:3%;padding-bottom:1%;">
  <h1 class="login-header" style="width:60%;margin-left:20%;">Ponuda vozila</h1>

<?php while($row = mysqli_fetch_assoc($result)): ?>



  <a href="car.details.php?id=<?php echo $row['id_vozila'] ?>" style="text-decoration:none;color:black;"><div class="item">
    <div class="item-content">
      <img src="images/<?php echo $row['slika'] ?>" alt="img" class="item-img">
      <h2 class="item-text"><?php echo $row['proizvodjac']." : ".$row['model']." : ".$row['tip_vozila'] ?></h2>
      <h3 style="margin-left: 55%;font-family: 'Roboto', sans-serif;"><?php echo $row['gorivo'] ?></h3>
      <h5 style="margin-left: 55%;font-family: 'Roboto', sans-serif;"><?php echo $row['opis'] ?></h5>
      <div class="price">
        <h3 style="text-align:right;font-family: 'Roboto', sans-serif;">Cena : <?php echo $row['cena']." € /24h" ?></h3>

      </div>

    </div>

  </a>



  </div>
<?php endwhile ?>

</div>
<?php require 'includes/footer.php'; ?>
