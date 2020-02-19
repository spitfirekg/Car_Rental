<?php require 'includes/header.php'; ?>

<?php
  //Konekcija sa bazom podataka
  require 'config/dbConnect.php';

  $sql = "SELECT * FROM vozila ORDER BY cena ASC";
  $result = mysqli_query($conn,$sql);
 ?>

<div class="container" style="padding-top:2%;padding-bottom:2%;margin-bottom:5%;">

  <?php if(isset($_SESSION['admin'])): ?>

  <h1 class="login-header" style="width:60%;margin-left:20%;">Lista vozila</h1>



    <table>
      <tr>
        <th>ID</th>
        <th>Slika</th>
        <th>Tip</th>
        <th>Proizvodjac</th>
        <th>Model</th>
        <th>Gorivo</th>
        <th>Cena</th>
        <th>Detalji</th>
      </tr>
      <?php while($row=mysqli_fetch_assoc($result)): ?>
        <tr class="user-data-table">
          <td><?php echo $row['id_vozila'] ?></td>
          <td class="admin.table.img-td"><img src="images/<?php echo $row['slika'] ?>" style="width:100px;"></td>
          <td><?php echo $row['tip_vozila'] ?></td>
          <td><?php echo $row['proizvodjac'] ?></td>
          <td><?php echo $row['model'] ?></td>
          <td><?php echo $row['gorivo'] ?></td>
          <td><?php echo $row['cena'] ?></td>
          <td><a href="admin.vozila.detalji.php?id=<?php echo $row['id_vozila'] ?>">Detalji</a></td>

        </tr>
      <?php endwhile ?>
    </table>

    <a href="car.add.php" style="text-decoration:none;"><h1 class="login-header" style="width:60%;margin-left:20%;">Dodavanje novog vozila</h1></a>

<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>
</div>



<?php require 'includes/footer.php'; ?>
