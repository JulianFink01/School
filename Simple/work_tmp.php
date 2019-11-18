<?php
include("db.php");
include("./Php_scripts/slideshow.php");
include("./Php_scripts/work.php");
?>
<div id="work">

    <h1>Work:</h1> 
    <table id="work_table">
        <tr>
            <?php
            $events=getEvents();
            foreach ($events as $index => $event) {
                ?>
                <td>
                    <!-- Slideshoe -->
                     <a class="work-text"><?php echo $event["name"] ?></a>
                    <div class="work-container">
                        <div class="slideshow-container" id="slideShow">
                            <?php
                            $images = getImages($index + 1);
                            foreach ($images as $index => $image) {
                                ?>
                                <div class="mySlides<?php echo $event["id"]?> fade">
                                    <div class="numbertext"><?php
                                        echo $index + 1;
                                        echo ' / ' . count($images)
                                        ?></div>
                                    <img src="<?php echo $image['src'] ?>" style="width:100%">
                                    <div class="text"><?php echo $image["caption"] ?></div>
                                </div>
                            <?php } ?>

                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        </div>

                        <!-- ---- -->
                       
                        <a class="work-span"><?php echo $event["location"] ?></a>

                        <form class="more-images-form" action="SlideShow_tmp.php" method="post">
                            <input type="hidden" name="eventid" value="<?php echo $event["id"] ?>" readonly />
                            <input onclick="showSlideShow()" name="loadSlide"type="submit" value="+" >
                        </form>
                    </div>
                </td>


                <?php
                if (($index + 1) % 3 == 0) {
                    echo "</tr><tr>";
                }
            }
            ?>
        </tr>

    </table>

</div>

<script type="text/javascript"src="js/slideshow.js"></script>
<?php
$arr = "[";
$ev = getEvents();
 foreach ($ev as $index => $event) {
     $arr=$arr."mySlides".$event['id'];
     if($index < count($ev)-1){
         $arr=$arr.",";
     }
 }
 
 $arr=$arr."]";
 echo "$arr";
?>