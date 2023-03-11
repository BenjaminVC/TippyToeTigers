<!DOCTYPE html>
<html>
<head>
    <title>Login/Signup Form</title>
</head>
<body>

<h2>Login Form</h2>
<form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>

    <input type="submit" value="Login">
</form>

<h2>Signup Form</h2>
<form method="post" action="signup.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br>

    <input type="submit" value="Signup">
</form>

</body>
</html>