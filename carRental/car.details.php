<?php require 'includes/header.php'; ?>

<?php
  require 'config/dbConnect.php';

  //Rezultati odabranog Vozila
  $sqlV = "SELECT * FROM vozila WHERE id_vozila = {$_GET['id']}";
  $resultV = mysqli_query($conn,$sqlV);
  while($rowV = mysqli_fetch_assoc($resultV)){
    $tip = $rowV['tip_vozila'];
    $proizvodjac = $rowV['proizvodjac'];
    $model = $rowV['model'];
    $gorivo = $rowV['gorivo'];
    $slika = $rowV['slika'];
    $cena_po_danu = $rowV['cena'];
    $id_vozila = $rowV['id_vozila'];
  }


  //Dobijanje rezultata o korisniku
  if(isset($_SESSION['username'])){
  $usernameS = $_SESSION['username'];
  $sqlU = "SELECT * FROM korisnici WHERE username = '$usernameS'";
  $resultU = mysqli_query($conn,$sqlU);
  while($rowU = mysqli_fetch_assoc($resultU)){
    $ime = $rowU['ime'];
    $prezime = $rowU['prezime'];
    $username = $rowU['username'];
    $email = $rowU['email'];
    $telefon = $rowU['telefon'];
   }
  }


  //REZERVACIJA VOZILA
  //Ukoliko je aktivan taster rezervisi
  if(isset($_POST['reserve'])){
    //Prihvatiti sve podatke koji su uneti u formu
    //Podaci o automobilu
    $tip = mysqli_real_escape_string($conn,$_POST['tip']);
    $proizvodjac = mysqli_real_escape_string($conn,$_POST['proizvodjac']);
    $model = mysqli_real_escape_string($conn,$_POST['model']);
    $gorivo = mysqli_real_escape_string($conn,$_POST['gorivo']);
    $cena_po_danu = mysqli_real_escape_string($conn,$_POST['cena']);
    $ukupna_cena = mysqli_real_escape_string($conn,$_POST['ukupno']);
    $id_vozila = mysqli_real_escape_string($conn,$_POST['id_vozila']);

    //Podaci o korisniku
    $ime = mysqli_real_escape_string($conn,$_POST['ime']);
    $prezime = mysqli_real_escape_string($conn,$_POST['prezime']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $telefon = mysqli_real_escape_string($conn,$_POST['telefon']);

    $od_datuma = mysqli_real_escape_string($conn,$_POST['od_datuma']);
    $do_datuma = mysqli_real_escape_string($conn,$_POST['do_datuma']);
    $datum = date("Y-m-d");

    //Formatiranje datumima
    $od_format = date('y-m-d',strtotime($od_datuma));
    $do_format = date('y-m-d',strtotime($do_datuma));

    //Proracun ukupnog broja dana rezervacije

    //Ukupno dana - razlika
    $ukupno_dana = (strtotime($do_format) - strtotime($od_format)) / (60 * 60 * 24);
    //Proracun CENA * BROJ DANA
    $ukupna_cena = $ukupno_dana * $cena_po_danu;



    //SQL za rezervaciju vozila
    $sql = "INSERT INTO rezervacije (ime,prezime,username,email,telefon,
                                    id_vozila, tip,proizvodjac,model,gorivo,
                                     od_datuma,do_datuma,datum_rezervacije,ukupna_cena)
                                     VALUES
                                     ('$ime','$prezime','$username','$email','$telefon',
                                     '$id_vozila','$tip','$proizvodjac','$model','$gorivo',
                                      '$od_format','$do_format','$datum','$ukupna_cena')";
    mysqli_query($conn,$sql);
    header("Location:succes.reserve.php");

 }
 ?>



 <div class="container" style="padding-bottom:2%;margin-bottom:3%;">

   <div class="detail-img-div">
     <img src="images/<?php echo $slika ?>" alt="image" class="detail-img">
   </div>

   <div class="detail-input-div">
     <h3 class="detail-input"><?php echo $tip ?></h3>
     <h3 class="detail-input"><?php echo $proizvodjac." - ".$model ?></h3>
     <h3 class="detail-input"><?php echo "Vrsta goriva : ".$gorivo ?></h3>
     <h3 class="detail-input"><?php echo "CENA : ".$cena_po_danu." € / 24h" ?></h3>

     <?php
       $check = "SELECT * FROM rezervacije WHERE id_vozila = {$_GET['id']}";
       $check_result = mysqli_query($conn,$check);

         ?>


  </div>


  <?php if(isset($_SESSION['username'])): ?>
  <?php if(mysqli_num_rows($check_result) > 0): ?>

    <p class="login-header" style="margin-top:12%;" >U tabeli ispod mozete pogledati u kojim terminima je vozilo vec rezervisano</p>
    <table>
      <tr>
        <th>Od datuma</th>
        <th>Do datuma</th>
      </tr>

        <?php  while($check_row = mysqli_fetch_assoc($check_result)):
          //Formatiranje prikaza datuma
           $od_datuma = $check_row['od_datuma'];
           $od_format = date_create($od_datuma);
           $od=date_format($od_format, 'd-m-Y');

           $do_datuma = $check_row['do_datuma'];
           $do_format = date_create($do_datuma);
           $do=date_format($do_format, 'd-m-Y'); ?>

      <tr class="user-data-table">
        <td><?php echo $od?></td>
        <td><?php echo $do ?></td>
      <?php endwhile ?>
      </tr>
    </table>
  <?php endif ?>
<?php endif ?>





  <hr style="width:60%;margin-top:2%;margin-bottom:2%;">

  <?php if(!isset($_SESSION['username'])): ?>
    <h2 class="login-header">Ukoliko zelite da rezervisete vozilo  morate biti
                            <a href="login.php">ulogovani</a></h2>
  <?php endif ?>

  <?php if(isset($_SESSION['username'])): ?>
  <form action="car.details.php" method="post">

  <h2 class="login-header" style="width:60%;margin-left:20%;">Rezervacija vozila</h2>
  <input type="hidden" name="tip" value="<?php echo $tip ?>">
  <input type="hidden" name="proizvodjac" value="<?php echo $proizvodjac ?>">
  <input type="hidden" name="model" value="<?php echo $model ?>">
  <input type="hidden" name="gorivo" value="<?php echo $gorivo ?>">
  <input type="hidden" name="cena" value="<?php echo $cena_po_danu ?>">
  <input type="hidden" name="ukupno" value="<?php echo $ukupna_cena ?>">
  <input type="hidden" name="id_vozila" value="<?php echo $id_vozila ?>">
  <input type="hidden" name="id_vozila" value="<?php echo $datum ?>">

  <input type="text" name="ime" value="<?php echo $ime ?>" class="detail-input-user" style="margin-left:17%;">
  <input type="text" name="prezime" value="<?php echo $prezime ?>" class="detail-input-user">
  <input type="text" name="username" value="<?php echo $username ?>" class="detail-input-user"><br>
  <input type="text" name="email" value="<?php echo $email ?>" class="detail-input-user" style="margin-left:28%;">
  <input type="text" name="telefon" value="<?php echo $telefon ?>" class="detail-input-user"><br>

  <input type="date" name="od_datuma" class="detail-input-user" style="margin-left:28%;">
  <input type="date" name="do_datuma" class="detail-input-user">
  <input type="submit" name="reserve" value="Rezervisite vozilo" class="reservation-btn">

  </form>
<?php endif ?>

  </div>

 </div>

<?php require 'includes/footer.php'; ?>
