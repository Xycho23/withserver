<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "PHW#84#jeor";
$database = "rfiddatas"; // Removed .admin

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs to prevent SQL injection
        $email = $_POST['email'];
        $password = $_POST['pwd'];

        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id FROM admin WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Execute the SQL statement
        $stmt->execute();

        // Check if there is a row matching the credentials
        if ($stmt->rowCount() > 0) {
            // Authentication successful, redirect or perform any other actions
            echo "Login successful!";
        } else {
            // Authentication failed
            echo "Invalid email or password";
        }
    }
} catch(PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
