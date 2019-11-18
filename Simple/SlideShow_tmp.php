<?php
include("db.php");
include("head.php");
include("./Php_scripts/slideshow.php");
?>


<div class="slideshow-container" id="slideShow">
    <?php
    foreach ($images as $index => $image) {
        ?>

        <div class="mySlides fade">
             <div onclick="showSlideShow()"id="closeSlideshow">X</div>
            <div class="numbertext"><?php echo $index +1; echo ' / '.count($images)?></div>
            <img src="<?php echo $image['src']?>" style="width:100%">
            <div class="text"><?php echo $image["caption"]?></div>
        </div>
    <?php } ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>

<script src="js/slideshow.js"></script>
