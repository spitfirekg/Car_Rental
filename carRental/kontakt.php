<?php require 'includes/header.php'; ?>

<div class="container">

  <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAs1gjsHEUNudvadO5tNtSpBXPU71ZDMAE'></script><div style='overflow:hidden;height:400px;width:520px;'><div id='gmap_canvas' style='height:400px;width:520px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://add-map.com/'>embed google map in wordpress</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=c701a4a9eb86ddfaff1cdf22465475a58b3d5314'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(44.020527,20.909574),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(44.020527,20.909574)});infowindow = new google.maps.InfoWindow({content:'<strong>Rent Pro</strong><br>Nepoznata Adresa<br> Kragujevac<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
  <div class="container-location-text">
      <h3 class="kontakt-text">Mozete nas kontaktirati</h3>
      <p class="kontakt-text">Adresa : xxxxxxxxxxxxxxxxxx Kragujevac</p>
      <p class="kontakt-text">Telefon 1 : 034 xxx-xxx-x</p>
      <p class="kontakt-text">Telefon 2 : 060 xxx-xxx-x</p>
      <p class="kontakt-text">Nas E-mail <a href="mailto:neki.mail@gmail.com?Subject=Hello%20again" target="_top">neki.mail@gmail.com</a></p>

  </div>
  </div>




  <?php  include 'includes/footer.php';?>

  <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=c701a4a9eb86ddfaff1cdf22465475a58b3d5314'>
  </script>

</div>

<?php require 'includes/footer.php'; ?>
