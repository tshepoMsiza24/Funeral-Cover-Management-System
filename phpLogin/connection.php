<?php
// Replace these variables with your actual database credentials
$host = "localhost"; // Database host
$dbusername = "root"; // Database username
$dbpassword = "root"; // Database password
$dbname = "funeral_service_database"; // Database name

// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize($input) {
    // Prevent SQL injection
    global $conn;
    $input = mysqli_real_escape_string($conn, $input);
    // Prevent XSS attacks
    $input = htmlspecialchars($input);
    return $input;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = sanitize($_POST["username"]);
    $password = sanitize($_POST["password"]);
    
    // SQL query to check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User exists, redirect to dashboard or wherever you want
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password
        echo "Invalid username or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
