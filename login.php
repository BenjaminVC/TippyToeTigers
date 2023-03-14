<?php
session_start();

// check if user is logged in
if (isset($_SESSION["username"]) && isset($_SESSION["permission"])) {
    if ($_SESSION["permission"] == 1) {
        header("Location: manage.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

// process POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check for missing fields
    if (empty($_POST["username"])) {
        $error_message = "Missing username field";
    } elseif (empty($_POST["password"])) {
        $error_message = "Missing password field";
    } else {
        try {
            // connect to database
            $db = new PDO("sqlite:account.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare and execute SQL statement to find user
            $stmt = $db->prepare("SELECT * FROM account WHERE username = :username AND password = :password");
            $stmt->execute(array(':username' => $_POST["username"], ':password' => $_POST["password"]));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // check if user exists
            if ($user) {
                $_SESSION["username"] = $user["username"];
                $_SESSION["permission"] = $user["permission"];
                $_SESSION["fullname"] = $user["fullname"];
                header("Location: manage.php");
                exit;
            } else {
                // increment login attempt counter and display error message
                if (isset($_SESSION["login_attempts"])) {
                    $_SESSION["login_attempts"]++;
                } else {
                    $_SESSION["login_attempts"] = 1;
                }
                $error_message = "Login failed (attempt " . $_SESSION["login_attempts"] . ")";
            }
        } catch (PDOException $e) {
            // checks if database connection failed
            $error_message = "Connection failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <th colspan="2">Login Form</th>
            </tr>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit" id="submit">
                    <input type="button" value="Back" id="button" onclick="location.href='./index.php'">
                </td>
            </tr>
        </table>
        <br>
    </form>
    <br>
    <?php
    // display error message if any
    if (isset($error_message)) {
        echo "<p>Error: " . $error_message . "</p>";
    }
    ?>
</body>
</html>