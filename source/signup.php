<?php
// Start session
session_start();

// Connect to database
$db = new PDO('sqlite:gameDB.db');
// Handle signup request
if (isset($_POST['signup'])) {
    // Hash password
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      // Check if username and email already exist
      $stmt = $db->prepare('SELECT COUNT(*) FROM user_info WHERE username = ? OR email = ?');
      $stmt->execute([$_POST['username'], $_POST['email']]);
      $count = $stmt->fetchColumn();
  
      if ($count > 0) {
          // Username or email already exist, redirect to error page
          echo "<p>Username or email already exists. Please choose a different one.</p>";
          exit();
      }

    // Insert user info into database
    $stmt = $db->prepare('INSERT INTO user_info (username, first_name, last_name, email) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email']]);

    // Insert user account into database
    $stmt = $db->prepare('INSERT INTO user_account (username, user_password) VALUES (?, ?)');
    $stmt->execute([$_POST['username'], $_POST['password']]);

    // Redirect to login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="assets/signup.css">
    <title>Login/Signup</title>
</head>

<body>
    <h1>Signup</h1>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <br>
        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>   
        <div class="button-container">
        <button type="submit" name="signup" class="signup">Signup</button>
        <a href="login.php"><button type="button" class="login">Login</button></a>
        </div>
    </form>
</body>

</html>