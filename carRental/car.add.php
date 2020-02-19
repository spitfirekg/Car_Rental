<?php require 'includes/header.php'; ?>

<?php
require 'config/dbConnect.php';

$errors = array();

if(isset($_POST['but_upload'])){
  //prihvatanje rezultat unosa iz forme
  $tip = mysqli_real_escape_string($conn,$_POST['tip']);
  $proizvodjac = mysqli_real_escape_string($conn,$_POST['proizvodjac']);
  $model = mysqli_real_escape_string($conn,$_POST['model']);
  $gorivo = mysqli_real_escape_string($conn,$_POST['gorivo']);
  $cena = mysqli_real_escape_string($conn,$_POST['cena']);
  $opis = mysqli_real_escape_string($conn,$_POST['opis']);

  if(empty($tip)){array_push($errors,"Niste uneli tip vozila !");}
  if(empty($proizvodjac)){array_push($errors,"Niste uneli proizvodjaca vozila !");}
  if(empty($model)){array_push($errors,"Niste uneli model vozila !");}
  if(empty($gorivo)){array_push($errors,"Niste uneli gorivo vozila !");}
  if(empty($cena)){array_push($errors,"Niste uneli cenu vozila !");}
  if(empty($opis)){array_push($errors,"Niste uneli opis vozila !");}

  if(count($errors) == 0){

  $name = $_FILES['file']['name'];
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){

     // Insert record
     $query = "INSERT INTO vozila (tip_vozila,proizvodjac,model,gorivo,slika,cena,opis) VALUES ('$tip','$proizvodjac','$model','$gorivo','$name','$cena','$opis')";
     mysqli_query($conn,$query);


     // Upload file
     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

     header("Location:vozila.admin.php");

  }

}
}
?>


<div class="container" style="padding-top:2%;padding-bottom:2%;margin-bottom:5%;">

  <h1 class="login-header" style="width:70%;margin-left:15%;">Unesite podatke za novo vozilo</h1>


  <form method="post" action="" enctype='multipart/form-data'>
    <?php require 'errors.php'; ?>
    <input type="text" name="tip" placeholder="Tip Vozila" style="margin-left:8%;text-align:center;">
    <input type="text" name="proizvodjac" placeholder="Proizvodjac" style="text-align:center;">
    <input type="text" name="model" placeholder="Model" style="text-align:center;">
    <input type="text" name="gorivo" placeholder="Vrsta goriva" style="text-align:center;">
    <input type="text" name="cena" placeholder="Cena po danu" style="text-align:center;">
    <p style="text-align:center">Opis vozila : </p>
    <textarea name="opis" rows="4" cols="40" style="width:20%;margin-left:40%;"></textarea><br>
    <p style="text-align:center">Izaberite sliku : </p>
    <input type='file' name='file' style="width:20%;margin-left:40%;" /><br>
    <input type='submit' value='Sacuvaj' name='but_upload' style="width:20%;margin-left:40%;margin-top:2%;">
  </form>


</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#insert').click(function(){
    let image_name = $('#image').val();
    if(image_name == ''){
      alert('Molimo odaberite sliku');
      return false;
    }else{
      let extension = $('#image').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extension,['gif','png','jpg','jpeg']) == -1){
        alert("Fajl koji ste dodali nije odgvarajuce extenzije");
        $('#image').val('');
        return false;
      }
    }
  });
});

</script>

<?php require 'includes/footer.php'; ?>
