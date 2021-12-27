<?php
// The way damage is calculated in my solution is handled through simple polymorphism - Each child object will influences the calculation differently
// This segment of code will make more sense if you look at the Battle() method in the armyHandler.php file, as the calculations are called from there

class RandomEvent {

    public function influence(Army &$A, Army &$B, String &$log){}
}






class NoEvent extends RandomEvent {

        public function influence(Army &$A, Army &$B, String &$log){

            $log .= "<span>Neutral event generated! No effect applied!</span><br>";
            //This is a base scenario where no modifiers are applied
            
            //i represents each itteration of the next while
            $i = 1;
            //This while() is where the two armies clash and reduce each other's size
            while($A->getSize() > 0 && $B->getSize() > 0){
                $log .= "<br>" .  $i . ": ";
                $sizeOfFirst = $A->getSize();
                $sizeOfSecond = $B->getSize();

                $damage = random_int($sizeOfFirst/2, $sizeOfFirst);
                $log .= "The " . $A->getName() . " army (Soldiers: " . $sizeOfFirst . ") attacked first! Causing " . $damage . " casualties!<br>";
                $B->setSize($sizeOfSecond - $damage);

                $damage = random_int($sizeOfSecond/2, $sizeOfSecond);
                $log .= "The " . $B->getName() . " army (Soldiers: " . $sizeOfSecond . ") then counter attacked! Causing " . $damage . " casualties!<br>";       
                $A->setSize($sizeOfFirst - $damage);
                $i += 1;
        }
    }
}






class Generals extends RandomEvent {

    public function influence(Army &$A, Army &$B, String &$log){

        $log .= "<span>Each army has a general present!</span><br>";
        //In this scenario the general encourages the soldiers to do more damage
        $general1 = $A->getSize() % 10 + random_int(1,10);
        $general2 = $B->getSize() % 10 + random_int(1,10);
        
        //i represents each itteration of the next while
        $i = 1;
        //This while() is where the two armies clash and reduce each other's size
        while($A->getSize() > 0 && $B->getSize() > 0){
            $log .= "<br>" .  $i . ": ";
            $sizeOfFirst = $A->getSize();
            $sizeOfSecond = $B->getSize();

            $damage = random_int($sizeOfFirst/2, $sizeOfFirst) + $general1;

            $log .= "The " . $A->getName() . " army (Soldiers: " . $sizeOfFirst . ") attacked first! Causing " . $damage  .
            " casualties!<br>The general added: " . $general1 . "<br>";
            
            $B->setSize($sizeOfSecond - $damage);

            $damage = random_int($sizeOfSecond/2, $sizeOfSecond) + $general2;

            $log .= "The " . $B->getName() . " army (Soldiers: " . $sizeOfSecond . ") then counter attacked! Causing " . $damage .
            " casualties!<br>The general added: " . $general2 . "<br>";       

            $A->setSize($sizeOfFirst - $damage);
            $i += 1;
        }
    }
}






class MassConfusion extends RandomEvent {

    public function influence(Army &$A, Army &$B, String &$log){

        $log .= "<span>A chaotic wizard caused mass confusion! Armies will switch attack order each turn!</span><br>";
        //In this scenario the attack order has a chance to change each turn
        
        //i represents each itteration of the next while
        $i = 1;
        //This while() is where the two armies clash and reduce each other's size
        while($A->getSize() > 0 && $B->getSize() > 0){
            $log .= "<br>" .  $i . ": ";
            $sizeOfFirst = $A->getSize();
            $sizeOfSecond = $B->getSize();

            $damage = random_int($sizeOfFirst/2, $sizeOfFirst);
            $log .= "The " . $A->getName() . " army (Soldiers: " . $sizeOfFirst . ") attacked first! Causing " . $damage . " casualties!<br>";
            $B->setSize($sizeOfSecond - $damage);

            $damage = random_int($sizeOfSecond/2, $sizeOfSecond);
            $log .= "The " . $B->getName() . " army (Soldiers: " . $sizeOfSecond . ") then counter attacked! Causing " . $damage . " casualties!<br>";       
            $A->setSize($sizeOfFirst - $damage);
            $i += 1;
            swap($A, $B);
            $log .= "<span>Order of attack reversed!</span>";
       }
    }
}






class Dragon extends RandomEvent {

    public function influence(Army &$A, Army &$B, String &$log){

        $log .= "<span>A dragon is flying over the battlefield! This will make the soldiers fight with more caution!</span><br>";
        //This is a base scenario where no modifiers are applied
        
        $dragon = (($A->getSize() + $B->getSize())/2) % 10;

        //i represents each itteration of the next while
        $i = 1;
        //This while() is where the two armies clash and reduce each other's size
        while($A->getSize() > 0 && $B->getSize() > 0){
            $log .= "<br>" .  $i . ": ";
            $sizeOfFirst = $A->getSize();
            $sizeOfSecond = $B->getSize();

            $damage = abs(random_int($sizeOfFirst/2, $sizeOfFirst) - $dragon);
            
            $log .= "The " . $A->getName() . " army (Soldiers: " . $sizeOfFirst . ") attacked first! Causing " . $damage . " casualties!<br>";
            $B->setSize($sizeOfSecond - $damage);

            $damage = abs(random_int($sizeOfSecond/2, $sizeOfSecond) - $dragon);
            

            $log .= "The " . $B->getName() . " army (Soldiers: " . $sizeOfSecond . ") then counter attacked! Causing " . $damage . " casualties!<br>";       
            $A->setSize($sizeOfFirst - $damage);
            $i += 1;
    }
}
}



?>