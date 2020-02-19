<?php require 'includes/header.php'; ?>

<?php
  require 'config/dbConnect.php';
  $sql = "SELECT * FROM korisnici";
  $result = mysqli_query($conn,$sql);





 ?>

<div class="container" style="padding-top:2%;padding-bottom:2%;">

  <h1 class="login-header" style="width:80%;margin-left:10%;">Podaci o korisnicima</h1>
  <?php if(isset($_SESSION['admin'])): ?>

  <table>
    <tr>
      <th>Id</th>
      <th>Ime</th>
      <th>Prezime</th>
      <th>Username</th>
      <th>Email</th>
      <th>Mesto</th>
      <th>Adresa</th>
      <th>Telefon</th>
    </tr>
<?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr class="user-data-table">
      <td><?php echo $row['id_korisnika'] ?></td>
      <td><?php echo $row['ime'] ?></td>
      <td><?php echo $row['prezime'] ?></td>
      <td><a href="korisnici.admin.details.php?username=<?php echo $row['username'] ?>"><?php echo $row['username']  ?></a></td>
      <td><a href="mailto:<?php echo $row['email'] ?>">E-mail</a></td>
      <td><?php echo $row['grad'] ?></td>
      <td><?php echo $row['adresa'] ?></td>
      <td><?php echo $row['telefon'] ?></td>

    </tr>
  <?php endwhile ?>


  </table>
<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>

</div>






<?php require 'includes/footer.php'; ?>
