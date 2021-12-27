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
<div class="surface">
    
    <div class="title">
        <br>
        <h1>Two Armies Battle Simulator</h1>
        <h2>Bornfight selection assignment</h2>
        <p>Author: Filip Vasiljević</p>
    </div>    
    
    <form method="get" action="battle.php">
            <div class="inputContainer">
                <label for="Army1">Please enter the number of soldiers in the <span>first</span> army:</label>
                <input type="number" id="Army1" name="Army1" required/><br/>
                <span id="Army1MSG"></span> <br>
            </div>

            <div class="inputContainer">
                <label for="Army2">Please enter the number of soldiers in the <span>second</span> army:</label>
                <input type="number" id="Army2" name="Army2" required/><br/>
                <span id="Army2MSG"></span> <br>
            </div>
            
            <input type="submit" value="Submit" /><br><br>
    </form>
</div>
</body>
</html>