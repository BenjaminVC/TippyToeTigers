<?php
session_start();
?>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="homePage.css">
    </head>

    <body>
        <p>Account: <?php echo $_SESSION['username']; ?> | logout</p>
    	<h2>Choose your game!</h2>
    	<ul>
    		<button><a href="snake.php">Snake</a></button>
    		<button><a href="hangman.php">Hangman</a></button>
    	</ul>
    </body>
</html>