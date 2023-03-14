<?php
// Start session
session_start();

// Connect to database
$db = new PDO('sqlite:gameDB.db');
// Handle signup request
if (isset($_POST['signup'])) {
    // Hash password
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user info into database
    $stmt = $db->prepare('INSERT INTO user_info (username, first_name, last_name, email) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['email']]);

    // Insert user account into database
    $stmt = $db->prepare('INSERT INTO user_account (username, user_password) VALUES (?, ?)');
    $stmt->execute([$_POST['username'], $_POST['password']]);

    // Update user account password in database
    // $stmt = $db->prepare('UPDATE user_account SET user_password = ? WHERE username = ?');
    // $stmt->execute([$hashed_password, $_POST['username']]);

    // Redirect to login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
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
        <button type="submit" name="signup">Signup</button>
    </form>
</body>

</html>