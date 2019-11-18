<?php

include("db.php");
include("./Php_scripts/work.php");
?>
<div id="work">

    <h1>Work:</h1> 
    <table id="work_table">
        <tr>
            <?php
            foreach ($events as $index => $event) {
                ?>
                <td>
                    <div class="work-container">
                        <img class="work-bild" src="<?php echo $event["thumbnail"] ?>">
                        <a class="work-text"><?php echo $event["name"] ?></a>
                        <a class="work-span"><?php echo $event["location"] ?></a>

                        <form class="more-images-form" action="SlideShow_tmp.php" method="post">
                            <input type="hidden" name="eventid" value="<?php echo $event["id"] ?>" readonly />
                            <input onclick="showSlideShow()" name="loadSlide"type="submit" value="+" >
                        </form>
                    </div>
                </td>
                
                
            <?php 
                if(($index+1)%3==0){
                   echo "</tr><tr>";
                }
            }
            ?>
        </tr>

    </table>

</div>

