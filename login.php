<?php
// Start session
session_start();

// Connect to database
// Connect to database
try {
    $db = new PDO('sqlite:gameDB.db');
} catch(PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Handle login request
if (isset($_POST['login'])) {
    // Get user account info
    $stmt = $db->prepare('SELECT * FROM user_account WHERE username = ?');
    $stmt->execute([$_POST['username']]);
    $user_account = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verify password
    if ($user_account && ($_POST['password']) == $user_account['user_password']) {
        echo "we verified a user";
        // Get user info
        $stmt = $db->prepare('SELECT * FROM user_info WHERE username = ?');
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set session variables
        $_SESSION['username'] = $user_account['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];

        // Redirect to games page
        header('Location: games.php');
        exit();
    } else {
        // Display error message
        $error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    
    <h2>Login</h2>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>