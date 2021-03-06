<?php require 'includes/header.php'; ?>  

<?php
  //Konekcija sa bazom podataka
  require 'config/dbConnect.php';
  //Sve aktuelne id_rezervacije
  $sql = "SELECT * FROM rezervacije";
  $result = mysqli_query($conn,$sql);
 ?>

<div class="container" style="padding-top:2%;padding-bottom:2%;margin-bottom:5%;">

  <?php if(isset($_SESSION['admin'])): ?>

  <?php if(isset($_SESSION['admin'])): ?>

  <h1 class="login-header" style="width:50%;margin-left:25%;">Tabela aktuelnih rezervacija</h1>
  <p style="text-align:center">Id rezervacije je <spann style="color:red;">oznacen crvenom</spann> bojom ukoliko je rezervacija potvrdjena od strane administratora</p>
  <p style="text-align:center">Id rezervacije je <spann style="color:green;">oznacen zelenom</spann> bojom ukoliko je rezervacija nije potvrdjena od strane administratora</p>
  <p style="text-align:center">Ukoliko je krajnji rok rezervacije (Do datuma) - veci od trenutnog datuma : na tabeli nece biti izlistani rokovi koji su manji od trenutnog datuma</p>

  <table>
    <tr>
      <th>Id</th>
      <th>Proizvodjac</th>
      <th>Model</th>
      <th>Gorivo</th>
      <th>Datum rezervacije</th>
      <th>Korisnik</th>
      <th>Email</th>
      <th>Detalji rezervacije</th>
    </tr>

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

      $potvrda = $row['potvrda'];

      ?>


    <?php if($datum < $do_datuma): ?>
       <tr class="user-data-table">
         <td>
           <?php
           if($potvrda == 1)
           echo "<p style='color:red;'>$row[id_rezervacije]</p>";
           if($potvrda ==0)
           echo "<p style='color:green;'>$row[id_rezervacije]</p>";
           ?>
         </td>





         <td><?php echo $row['proizvodjac'] ?></td>
         <td><?php echo $row['model'] ?></td>
         <td><?php echo $row['gorivo'] ?></td>
         <td><?php echo $datumF ?></td>
         <td><a href="korisnici.admin.details.php?username=<?php echo $row['username'] ?>"><?php echo $row['username']; ?></a></td>
         <td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></td>
         <td><a href="reservation.detail.admin.php?id=<?php echo $row['id_rezervacije'] ?>">Detalji</a></td>


       </tr>
    <?php endif ?>
    <?php endwhile ?>
  </table>


  <h1 class="login-header">Tabela rezervacija ciji je krajni rok stariji od trenutnog datuma</h1>



   <table>
     <tr>
       <th>Id</th>
       <th>Proizvodjac</th>
       <th>Model</th>
       <th>Gorivo</th>
       <th>Datum rezervacije</th>
       <th>Korisnik</th>
       <th>Email</th>
       <th>Detalji rezervacije</th>
     </tr>
     <?php
      if($datum > $do_datuma): ?>
     <?php while($row=mysqli_fetch_assoc($result)): ?>
       <tr class="user-data-table">

       <td><?php echo $row['id_rezervacije'] ?></td>
       <td><?php echo $row['proizvodjac'] ?></td>
       <td><?php echo $row['model'] ?></td>
       <td><?php echo $row['gorivo'] ?></td>
       <td><?php echo $row['datum'] ?></td>
       <td><a href="korisnici.admin.details.php?username=<?php echo $row['username'] ?>"><?php echo $row['username']; ?></a></td>
       <td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></td>
       <td><a href="reservation.detail.admin.php?id=<?php echo $row['id_rezervacije'] ?>">Detalji</a></td>

       </tr>

     <?php endwhile ?>
      <?php endif ?>
   </table>

 <?php endif ?>

 <?php if(!isset($_SESSION['admin'])): ?>
   <h3 class="login-header">Niste ulogovani administrator !</h3>
 <?php endif ?>



<?php endif ?>

<?php if(!isset($_SESSION['admin'])) :?>
  <h1 class="login-header" style="width:50%;margin-left:25%;">Niste ulogovani administrator</h1>
<?php endif ?>
</div> 

<?php require 'includes/footer.php'; ?>                                                                                              
