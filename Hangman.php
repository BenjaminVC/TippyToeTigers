<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hangman</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="Hangman.css" />
</head>

<body>
  <?php
  echo 'Account: <strong>' . $_SESSION['username'] .
    '</strong> 
| <button><a href="logout.php">Logout</a></button> 
| <button><a href="games.php">Back</a></button>';
  ?>
  <div class="container">
    <div id="options-container"></div>
    <div id="letter-container" class="letter-container hide"></div>
    <div id="user-input-section"></div>
    <div id="score-container">Score: <span id="score">0</span></div>
    <canvas id="canvas"></canvas>
    <div id="new-game-container" class="new-game-popup hide">
      <div id="result-text"></div>
      <button id="new-game-button">New Game</button>
    </div>
  </div>
  <script src="Hangman.js"></script>
</body>

</html>