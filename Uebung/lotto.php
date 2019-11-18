<?php
  $lotto = range(1,49);
  $szahl = range(0,9);

 
      $ziehung = array_rand($lotto, 5);
   ?>
<!DOCTYPE html>
<html>
<head>
<title>Zufallselemente</title>
</head>
<body>

<h2>Lotto-Generator</h2>

    <p>Ihre sechs Zahlen lauten: <br />

    <?php 
        for($i = 0; $i < 5; $i++) {  ?>
            <img src="images/<?php echo $lotto[$ziehung[$i]]; ?>.gif">
        <?php } ?>
        Superzahl: <?php echo array_rand($szahl); ?> </p>


</body>
</html>