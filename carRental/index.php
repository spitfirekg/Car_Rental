<?php require 'includes/header.php'; ?>

<div class="container" style="margin-top:10%;height:300px;">
  <div class="timer">
    <img src="images/banner1.png" alt="banner" id="timer-image">
    <h1 id="image-timer-text">Veliki izbor automobila</h1>

  </div>



</div>

<script type="text/javascript">
//javascript za promenu slika u odredjenom vremenskom intervalu
let image = document.getElementById("timer-image");
            let currentPos = 0;
            let images = ["images/banner1.png", "images/banner2.png", "images/banner3.png"]

            function promeniSliku() {
                if (++currentPos >= images.length)
                    currentPos = 0;

                image.src = images[currentPos];
            }

            setInterval(promeniSliku, 3000);

</script>

<!--Javascript za promenu naslova zajedno sa slikama-->
<script type="text/javascript">
    let text = ["Gradimo poverenje", "Dostava na kucnu adresu", "Veliki izbor automobila"];
    let counter = 0;
    let elem = document.getElementById("image-timer-text");
    let inst = setInterval(change, 3000);

    function change() {
      elem.innerHTML = text[counter];
      counter++;
        if (counter >= text.length) {
      counter = 0;

  }
}
</script>

<?php require 'includes/footer.php'; ?>
