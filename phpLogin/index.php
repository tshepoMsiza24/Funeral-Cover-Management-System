<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>Admin</h1>
        <h2>Login</h2>
        <?php
      //  Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if username and password are provided
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Hard-coded admin credentials (in real scenario, fetch from the database)
                $admin_username = 'admin';
                $admin_password = 'admin123';

                // Check if provided credentials match the admin credentials
                if ($username == $admin_username && $password == $admin_password) {
                    // Redirect to admin dashboard or any other page
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "<p class='error-message'>Invalid username or password!</p>";
                }
            } else {
                echo "<p class='error-message'>Please enter username and password!</p>";
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
