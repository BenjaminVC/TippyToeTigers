<?php
// Start session
session_start();

// Connect to database
try {
    $db = new PDO('sqlite:gameDB.db');
} catch(PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Query high scores for Snake game
$stmt_snake = $db->prepare('SELECT username, SUM(score) AS total_score FROM rounds WHERE game_id = 2 GROUP BY username ORDER BY total_score DESC');
$stmt_snake->execute();
$snake_scores = $stmt_snake->fetchAll(PDO::FETCH_ASSOC);

// Query high scores for Hangman game
$stmt_hangman = $db->prepare('SELECT username, SUM(score) AS total_score FROM rounds WHERE game_id = 1 GROUP BY username ORDER BY total_score DESC');
$stmt_hangman->execute();
$hangman_scores = $stmt_hangman->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" href="/assets/games.css">
    </head>

    <body>
        <?php  echo 'Account: <strong>' . $_SESSION['username'] . 
        '</strong> | <a href="logout.php">Logout</a>';?>
    	<div class="center" id="logo">
            <h2 class="center">😼 Choose your game!</h2>
    	
    	    <button><a href="snake.php">Snake</a></button>
    	    
        </div>

        <br>
        <h2 class="center">Snake High Scores</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Total Score</th>
        </tr>
        <?php foreach ($snake_scores as $score): ?>
        <tr>
            <td><?php echo $score['username']; ?></td>
            <td><?php echo $score['total_score']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="center" >
    <button><a href="hangman.php">Hangman</a></button>
    <h2 class="center">Hangman High Scores</h2>
    </div>
    <table>
        <tr>
            <th>Username</th>
            <th>Total Score</th>
        </tr>
        <?php foreach ($hangman_scores as $score): ?>
        <tr>
            <td><?php echo $score['username']; ?></td>
            <td><?php echo $score['total_score']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </body>
</html>