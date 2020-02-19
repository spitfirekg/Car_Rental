<?php require 'includes/header.php'; ?>

<?php
$errors=array();
//Konekcija sa bazom podataka
require 'config/dbConnect.php';
  //sql Upit za rentirana vozila ulogovanog korisnika
  $sql = "SELECT * FROM rezervacije WHERE username = '$_SESSION[username]'" ;
  $result = mysqli_query($conn,$sql);
  if(empty($result)){array_push($errors,"Trenutno nemate rentirana vozila");}


 ?>

<div class="container" style="padding-top:1%;padding-bottom:2%;">
  <h1 class="login-header" style="width:60%;margin-left:20%;">Istorija rentranja vozila</h1>

  <table>
    <tr>
      <th>Id</th>
      <th>Tip</th>
      <th>Proizvodjac</th>
      <th>Model</th>
      <th>Gorivo</th>
      <th>Od datuma</th>
      <th>Do datuma</th>
      <th>Datum rezervacije</th>
      <th>Ukupna cena</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)):
      //Formatiranje prikaza datuma
        $od_datuma = $row['od_datuma'];
        $od_format = date_create($od_datuma);
        $od=date_format($od_format, 'd-m-Y');

        $do_datuma = $row['do_datuma'];
        $do_format = date_create($do_datuma);
        $do=date_format($do_format, 'd-m-Y');

        $datum = $row['datum_rezervacije'];
        $datum_format = date_create($datum);
        $datumF=date_format($datum_format, 'd-m-Y');


      ?>
      <tr class="user-data-table">
        <td><?php echo $row['id_rezervacije']?></td>
        <td><?php echo $row['tip']?></td>
        <td><?php echo $row['proizvodjac']?></td>
        <td><?php echo $row['model']?></td>
        <td><?php echo $row['gorivo']?></td>
        <td><?php echo $od ?></td>
        <td><?php echo $do ?></td>
        <td><?php echo $datumF ?></td>
        <td><?php echo $row['ukupna_cena']. " €"?></td>
      </tr>
    <?php endwhile ?>
  </table>


</div>

<?php require 'includes/footer.php'; ?>
