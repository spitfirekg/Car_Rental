<?php require 'includes/header.php'; ?>

<?php
    //Konekcija sa bazom podataka
    require 'config/dbConnect.php';

    $sql = "SELECT * FROM korisnici WHERE username='$_GET[username]'";
    $result = mysqli_query($conn,$sql);


    //Broj rentiranja vozila
    $broj = "SELECT * FROM rezervacije WHERE username='$_GET[username]'";
    $broj_result = mysqli_query($conn,$broj);
    $broj_rentiranja = mysqli_num_rows($broj_result);

    //Datumi trentiranja vozila
    $datumi = "SELECT * FROM rezervacije WHERE username ='$_GET[username]'";
    $datumi_result = mysqli_query($conn,$datumi);


    if(isset($_POST['delete'])){


      $delete = "DELETE FROM korisnici WHERE username='$_POST[username]'";
      $delete_result = mysqli_query($conn,$delete);
      header("Location:korisnici.admin.php");

    }





 ?>





<div class="container" style="padding-bottom:2%;padding-top:2%;margin-bottom:5%;">

  <?php if(isset($_SESSION['admin'])): ?>

  <h1 class="login-header" style="width:80%;margin-left:10%;">Podaci o izabranom korisniku</h1>


  <?php while($row=mysqli_fetch_assoc($result)): ?>



    <p class="detail-text"><small>Id : </small><?php echo $row['id_korisnika'] ?></p>
    <p class="detail-text"><small>Ime : </small><?php echo $row['ime'] ?></p>
    <p class="detail-text"><small>Prezime : </small><?php echo $row['prezime'] ?></p>
    <p class="detail-text"><small>Username : </small><?php echo $row['username'] ?></p>
    <p class="detail-text"><small>Email : </small><?php echo $row['email'] ?></p>
    <p class="detail-text"><small>Grad/Mesto : </small><?php echo $row['grad'] ?></p>
    <p class="detail-text"><small>Adresa : </small><?php echo $row['adresa'] ?></p>
    <p class="detail-text"><small>Telefon : </small><?php echo $row['telefon'] ?></p>

    <h3 class="login-header" style="width:80%;margin-left:10%;">Korisnik <?php echo $row['username'] ?> je rentirao vozila : <?php echo $broj_rentiranja ?> puta</h3>
    <h4 class="login-header" style="width:80%;margin-left:10%;">Datumi renitanja korisnika <?php echo $row['username'] ?></h4>

      <table>
        <tr>
          <th>Id rezervacije</th>
          <th>Id Vozila</th>
          <th>Tip vozila</th>
          <th>Proizvodjac</th>
          <th>Gorivo</th>
          <th>Od datuma</th>
          <th>Do datuma</th>
          <th>Cena</th>
        </tr>
        <?php while($rent_row= mysqli_fetch_assoc($datumi_result)): ?>
          <tr class="user-data-table">
            <td><?php echo $rent_row['id_rezervacije'] ?></td>
            <td><?php echo $rent_row['id_vozila'] ?></td>
            <td><?php echo $rent_row['tip'] ?></td>
            <td><?php echo $rent_row['proizvodjac'] ?></td>
            <td><?php echo $rent_row['gorivo'] ?></td>
            <td><?php echo $rent_row['od_datuma'] ?></td>
            <td><?php echo $rent_row['do_datuma'] ?></td>
            <td><?php echo $rent_row['ukupna_cena'] ?></td>

          </tr>
          <?php endwhile ?>
      </table>

      <h1 class="login-header" style="width:80%;margin-left:10%;">Dali zelite da izbrisete ovog korisnika ?</h1>
  <form action="korisnici.admin.details.php" method="post">

      <input type="hidden" name="username" value="<?php echo $row['username'] ?>">
      <input type="submit" name="delete" value="IZBRISI" class="admin-table-btn-del">





    </form>
  <?php endwhile ?>

<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>

</div>

<?php require 'includes/footer.php'; ?>
