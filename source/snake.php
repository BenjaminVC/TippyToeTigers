<?php
session_start();
?>

<?php
// Check if this current request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  session_start();

  // $json_response = json_encode($_POST);
  // header('Content-Type: application/json');

  // echo $json_response;
  // // var_dump($_POST);

  // exit();
  
  //var_dump($_POST);
  // $json_response = json_encode($_POST);

  //   // Set content json header and print the json string
  //   header('Content-Type: application/json');
  //   echo $json_response;
  // exit();
  // Unpack the values that I expect from the POST request (do this inside a conditional)
  $round_id = isset($_POST['round_id']) ? $_POST['round_id'] : null;
  $username = isset($_SESSION['username']) ? strval($_SESSION['username']) : null;
  $game_id = isset($_POST['game_id']) ? $_POST['game_id'] : null;
  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
  $score = isset($_POST['score']) ? $_POST['score'] : null;

  if (!$round_id || !$username || !$game_id || !$category_id || !$score) {
    // If any of the expected values are null, return an error response
    $response = array('status' => 'error', 'message' => 'Missing required values', 'values' => $_POST);
    $json_response = json_encode($response);

    // Set content json header and print the json string
    header('Content-Type: application/json');
    echo $json_response;

    // Return so that we don't print the stuff below
    exit();
  }

  // Validate and sanitize data
  $round_id = filter_var($round_id, FILTER_SANITIZE_NUMBER_INT);
  $game_id = filter_var($game_id, FILTER_SANITIZE_NUMBER_INT);
  $category_id = filter_var($category_id, FILTER_SANITIZE_NUMBER_INT);
  $score = filter_var($score, FILTER_SANITIZE_NUMBER_INT);

  // Saving the extracted data to SQLite database
  // Connect to database
  ///////not allowed to do this///////
  try {
    $db = new PDO('sqlite:gameDB.db');
  } catch(PDOException $e) {
    
    // If we can't connect to the database, return an error response
    $response = array('status' => 'error', 'message' => 'Could not connect to database');
    $json_response = json_encode($response);

    // Set content json header and print the json string
    header('Content-Type: application/json');
    echo $json_response;

    // Return so that we don't print the stuff below
    exit();
  }

  $stmt = $db->prepare("INSERT INTO rounds (round_id, username, game_id, category_id, score) VALUES (?, ?, ?, ?, ?)");
  // $stmt->bindValue(1, $round_id, SQLITE3_INTEGER);
  // $stmt->bindValue(2, $username, SQLITE3_TEXT);
  // $stmt->bindValue(3, $game_id, SQLITE3_INTEGER);
  // $stmt->bindValue(4, $category_id, SQLITE3_INTEGER);
  // $stmt->bindValue(5, $score, SQLITE3_INTEGER);
  $stmt->execute([$round_id, $username, $game_id, $category_id, $score]);


  // JSON serializeing a success response
  $response = array('status' => 'success');
  $json_response = json_encode($response);

  // Set content json header and print the json string
  header('Content-Type: application/json');
  echo $json_response;

  // Return so that we don't print the stuff below
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport",
	content="width=device-width, initial-scale=1.0">
<title>TIPPYTOETIGERS SNAKE</title>
<link rel="stylesheet" href="assets/snake.css" />
<script type="text/javascript" src="games/snake.js"></script>
</head>
<body>
<?php  echo 'Account: <strong>' . $_SESSION['username'] . 
        '</strong> 
		| <button><a href="logout.php">Logout</a></button> 
		| <button><a href="games.php">Back</a></button>';?>
	<div class="logo" id="logo">TIPPYTOETIGERS STATUS = 😼</div>
	<span id="game-message" style="color:red"></span>
	<br /><br />
	<canvas id="board"></canvas>
	<h2 id="score"></h2>
	<script>
  		const snakeGame = new Snake(15, 30, 30); // creates a new Snake instance with a block size of 10 and a game board with 30 rows and 30 columns
  		snakeGame.start(); // starts the game
	</script>
	<br /><br />
</body>
</html>