<?php
session_start();
require('engine/image_gallery.php')
?>
<!DOCTYPE html>
<?php
include('engine/content.php');
echo $head;

?>
<body>
<?php render_menu(); ?>


  <section class="sections">
	  <header>
		  <h1>Galerie</h1>
	  </header>
    <div class="container">
    <?php 
    
    writeAllImages();
    
    ?>
    </div>




  </section>
  <?php echo $footer;/*
  require_once("textedit.php"); 
    */
    ?>
</body>
</html>

