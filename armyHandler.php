<?php

include 'randomEvents.php';

class Army{
    private int $size;
    private int $initiative;
    private string $name;    

    // Constructor - The "= null" workaround is used as a replacement for constructor overloading
    function __construct($name = null, $size = null) {
        if($name != null && $size != null){
            $this->name = $name;
            $this->size = $size;
            // I determine which army gets to attack first based on a randomly determined initiative score
            $this->resetInitiative();
        }
    }


    function getSize(){
        return $this->size;
    }

    function setSize($newSize){
        $this->size = $newSize;
    }

    function getInitiative(){
        return $this->initiative;
    }

    function getName(){
        return $this->name;
    }

    function resetInitiative(){
        $this->initiative = random_int(1, 20);
    }    
}






//Error Handling
function customError($errorMessage) {
    echo "<div class='result'> <div class='title'><h1>Error: " . $errorMessage . " </h1></div></div>";
    echo "<script>console.log('" . $errorMessage . "');</script>";
    //die();
  }






function swap(&$first, &$second){
    // This swap method will come in handy in the battle method for combat order manipulation
    $temporary;
    $temporary = $first;
    $first = $second;
    $second = $temporary;
}






function battle(Army $first, Army $second, RandomEvent $event, String &$log){
    
    // Making sure that an attacking order is established, the while serves as an if() and wont fire if the two armies have different initiative values
    while($first->getInitiative() == $second->getInitiative()){
        $first->resetInitiative();
        // I could probably get away with resetting the initiative value of just one Army, but it's a fast operation so I left it in out of fairness
        $second->resetInitiative();
    }

    if($second->getInitiative() > $first->getInitiative()){
        // If I swap the values of first and second in one if() statement I can avoid needless if()s in the $event->influence() while 
        swap($first, $second);
    }

    
    $log .= "<br><br><div class='log' id='log'>~~~The " . $first->getName() . " army scored a higer initiatieve! ("
    . $first->getInitiative() . " vs. " . $second->getInitiative() . ")~~~~<br>";
    
    // This is where damage gets calculated
    $event->influence($first, $second, $log);

    

    $log .= "</div>";

    if($first->getSize() <= 0 && $second ->getSize() > 0){
        echo "<script>console.log('Bing 1!');</script>";
        $first->setSize(0);
        return $second;
    }

    else if($second ->getSize() <= 0 && $first->getSize() > 0){
        echo "<script>console.log('Bing 2!');</script>";
        $second->setSize(0);
        return $first;
    }    
    
    else {
        echo "<script>console.log('Bing 3!');</script>";
        $first->setSize(0);
        $second->setSize(0);
        return new Army("Neither", 1);
    }


}



?>