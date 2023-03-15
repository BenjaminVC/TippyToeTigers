<?php
session_start();
?>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="/assets/games.css">
    </head>

    <body>
        <p>Account: <?php echo $_SESSION['username']; ?> | logout</p>
    	<div>
            <h2>😼 Choose your game!</h2>
    	
    	    <button><a href="snake.php">Snake</a></button>
    	    <button><a href="hangman.php">Hangman</a></button>
        </div>
    </body>
</html>