<html>

<head>
<meta charset="UTF-8">
<meta name="viewport",
	content="width=device-width, initial-scale=1.0">
<title>TIPPYTOETIGERS SNAKE</title>
<link rel="stylesheet" href="/assets/snake.css" />
<script type="text/javascript" src="/games/snake.js"></script>
</head>
<body>
	<div class="logo">TIPPYTOETIGERS 😼</div>
	<span id="game-message" style="color:red"></span>
	<br /><br />
	<canvas id="board"></canvas>
	<script>
  		const snakeGame = new Snake(15, 30, 30); // creates a new Snake instance with a block size of 10 and a game board with 30 rows and 30 columns
  		snakeGame.start(); // starts the game
	</script>

	<br /><br />
</body>
</html>