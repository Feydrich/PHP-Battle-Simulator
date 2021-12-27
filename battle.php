<?php

include 'armyHandler.php';

$handler1 = $_GET['Army1'];
$handler2 = $_GET['Army2'];

$Army1 = new Army("first", $handler1);
$Army2 = new Army("second", $handler2);
$Winner = new Army();
$log = "";

// Selecting 
$randomEventIndex = random_int(1,4);
switch($randomEventIndex){
    case 1:
        $randomEvent = new NoEvent();
    break;

    case 2:
        $randomEvent = new Generals();
    break;
    
    case 3:
        $randomEvent = new MassConfusion();
    break;

    case 4:
        $randomEvent = new Dragon();
    break;
}




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="author" content="Filip Vasiljević"/>
		<meta name="description" content="The Battle of 2 Armies Assignment"/>		
		<link rel="stylesheet" type="text/css" href="style.css"/>		
		<title>Two Armies Assignment</title>
	</head>

<body>
    <?php
        // Loads the results if no error was caused
         
        if($handler1 > 0 && $handler2 > 0){
             echo "<div class='result'><div class='title'><h1>The results:</h1></div>";

            //The random event that influences calculations is handled through a polymorphism with the randomEvent object
            $Winner = battle($Army1, $Army2, $randomEvent, $log);
            
            if($Winner->getName() != "Neither"){
                echo "<h1> The <span>";
            }
            else{
                echo "<h1><span>";
            }
       
            echo $Winner->getName() . "</span> army won the battle! </h1><br>";
            echo "<p>The <span>first</span> army started with " . $handler1 . " and was left with " . $Army1->getSize() . " soliders!</p>";
            echo "<p>The <span>second</span> army started with " . $handler2 .  " and was left with " . $Army2->getSize() . " soliders!</p>";
            echo "<br><button onclick='logVisibility()'>LOG</button><br>";
            echo $log;
        }
 
        else {
            customError("Entered impossible amount of soldiers!");
        }
    ?>
    
</div>


</body>

</html>


<script>
     function logVisibility() {
        var logElement = document.getElementById('log');
        if(logElement.style.visibility == 'hidden'){
            logElement.style.visibility = 'visible';
            logElement.style.animation = 'fade 2s';
        }
        else{
            logElement.style.visibility = 'hidden';
            logElement.style.animation = '';
        }
     }
</script>