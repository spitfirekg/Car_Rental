<?php require 'includes/header.php';?>

<?php
  //Konekcija sa bazomn podataka
  require 'config/dbConnect.php';
  $sql = "SELECT * FROM rezervacije WHERE id_rezervacije = {$_GET['id']}";
  $result = mysqli_query($conn,$sql);

  if(isset($_POST['potvrdi'])){
    $update = "UPDATE rezervacije SET potvrda = 1 WHERE id_rezervacije='$_POST[id_rezervacije]'";
    mysqli_query($conn,$update);
    header("Location:reservation.list.php");
  }

 ?>

<div class="container" style="padding-top:2%;padding-bottom:2%;">

  <?php if(isset($_SESSION['admin'])): ?>

  <h1 class="login-header" style="width:50%;margin-left:25%;">Detalji rezervacije</h1>

  <?php while($row = mysqli_fetch_assoc($result)):
    //Formatiranje datuma
    $od_datuma = $row['od_datuma'];
    $od_format = date_create($od_datuma);
    $od=date_format($od_format, 'd-m-Y');

    $do_datuma = $row['do_datuma'];
    $do_format = date_create($do_datuma);
    $do=date_format($do_format, 'd-m-Y');

    $datum = $row['datum_rezervacije'];
    $datum_format = date_create($datum);
    $datumF=date_format($datum_format, 'd-m-Y');

    $id_rezervacije = $row['id_rezervacije'];




    ?>



    <div class="reserve-detail">
      <h4 style="margin-bottom:-2%;">DATUM REZERVACIJE  :  <?php echo "<i><small>$datumF</small></i>" ?></h4>
      <hr width=50% style="margin-top:2%;">
      <h4 style="margin-bottom:-2%;">Id Rezervazacije :  <?php echo "<i><small>$row[id_rezervacije]</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Tip vozila :  <?php echo "<i><small>$row[tip]</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Proizvodjac :  <?php echo "<i><small>$row[proizvodjac]</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Model :  <?php echo "<i><small>$row[model]</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Gorivo :  <?php echo "<i><small>$row[gorivo]</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Od datuma :  <?php echo "<i><small>$od</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Do datuma :  <?php echo "<i><small>$do</small></i>" ?></h4>
      <h4 style="margin-bottom:-2%;">Cena u slucaju rentiranja vozila :  <?php echo "<i><small>$row[ukupna_cena]</small></i>" ?> €</h4>
      <hr width=50% style="margin-top:2%;">
      <h2 class="login-header" style="width:50%;margin-left:25%;">Potvrdite rezervaciju</h2>

      <form action="reservation.detail.admin.php" method="post">

        <?php if(isset($_SESSION['admin'])): ?>
        <input type="hidden" name="id_rezervacije" value="<?php echo $row['id_rezervacije'] ?>">
        <input type="submit" name="potvrdi" value="POTVRDI">
        <?php endif ?>

      </form>


    </div>


<?php endwhile ?>

<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>

</div>

<?php require 'includes/footer.php';?>
