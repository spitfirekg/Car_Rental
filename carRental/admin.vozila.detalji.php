<?php require 'includes/header.php'; ?>


<?php
//Povezivanje sa bazom podataka
require 'config/dbConnect.php';
//Prikaz detalja vozila
$sql = "SELECT * FROM vozila WHERE id_vozila = {$_GET['id']}";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
  $id_vozila = $row['id_vozila'];
  $slika = $row['slika'];
  $tip = $row['tip_vozila'];
  $proizvodjac = $row['proizvodjac'];
  $model = $row['model'];
  $gorivo = $row['gorivo'];
  $cena = $row['cena'];
  $opis = $row['opis'];
}

//Deo sa izmenom podataka
if(isset($_POST['update'])){
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $tip = mysqli_real_escape_string($conn,$_POST['tip']);
  $proizvodjac = mysqli_real_escape_string($conn,$_POST['proizvodjac']);
  $model = mysqli_real_escape_string($conn,$_POST['model']);
  $gorivo = mysqli_real_escape_string($conn,$_POST['gorivo']);
  $cena = mysqli_real_escape_string($conn,$_POST['cena']);
  $update = "UPDATE vozila SET tip_vozila='$tip',proizvodjac='$proizvodjac',model='$model',
             gorivo='$gorivo',cena='$cena' WHERE id_vozila=$id";
  $upd_result = mysqli_query($conn,$update);
  header("Location:vozila.admin.php");
}


//Deo sa brisanjem vozila iz baze podataka
if(isset($_POST['delete'])){
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $delete = "DELETE FROM vozila WHERE id_vozila=$id";
  mysqli_query($conn,$delete);
  header("Location:vozila.admin.php");
}
 ?>













<div class="container" style="padding-top:2%;padding-bottom:2%;margin-bottom:5%;">

  <?php if(isset($_SESSION['admin'])): ?>

<h1 class="login-header" style="width:60%;margin-left:20%;">Detalji izabranog vozila</h1>
<div class="detail-img-div">


<img src="images/<?php echo $slika ?>" alt="image" class="detail-img">
</div>
<div class="detail-input-div">
  <h3 class="detail-input"><?php echo $tip ?></h3>
  <h3 class="detail-input"><?php echo $proizvodjac." - ".$model ?></h3>
  <h3 class="detail-input"><?php echo "Vrsta goriva : ".$gorivo ?></h3>
  <h3 class="detail-input"><?php echo "CENA : ".$cena." € / 24h" ?></h3>
  <hr width=60%>
  <h4 class="detail-input">Kratki opis</h4>
  <h4 class="detail-input"><?php echo $opis?></h4>

</div>

<hr style="margin-top:7%;width:80%;">
<h1 class="login-header" style="width:60%;margin-left:20%;">Izmena podataka vozila</h1>

<form action="admin.vozila.detalji.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id_vozila ?>">
  <input type="text" name="tip" value="<?php echo $tip ?>" style="margin-left:5%;text-align:center;">
  <input type="text" name="proizvodjac" value="<?php echo $proizvodjac ?>" style="text-align:center;">
  <input type="text" name="model" value="<?php echo $model ?>" style="text-align:center;">
  <input type="text" name="gorivo" value="<?php echo $gorivo ?>" style="text-align:center;">
  <input type="text" name="cena" value="<?php echo $cena ?>" style="text-align:center;">
  <input type="submit" name="update" value="IZMENI">

</form>

<h1 class="login-header" style="width:60%;margin-left:20%;">Dali zelite da obrisete ovo vozilo</h1>
<form action="admin.vozila.detalji.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id_vozila ?>">
  <input type="submit" name="delete" value="IZBRISI" style="width:10%;margin-left:45%;">

</form>


<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>
</div>

<?php require 'includes/footer.php'; ?>
