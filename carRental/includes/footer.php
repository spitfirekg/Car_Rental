<div class="footer" style="padding-bottom:0.7%;">

  <p class="fotter-text">CopyRight - Art-Test &copy; <?php echo date("Y"); ?></p>

 <div class="fotter-content">
  <a href="administracija.php" class="footer-links">Administracija</a><br>
  <a href="o.nama.php" class="footer-links">O nama</a><br>
  <a href="kontakt.php" class="footer-links">Kontakt</a><br>
<?php if(isset($_SESSION['admin'])): ?>

    <a href="logout.php" class="footer-links">Logout</a>
<?php endif ?>

</div>


</div>




  </body>
</html>
