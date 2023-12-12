<?php
// Replace with your database credentials
session_start();
$servername = "localhost";
$username = "zaid";
$password = "1234";
$database = "attendance";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $role = $_POST["role"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $_SESSION["role"] = $role;
    $_SESSION["username"] = $username;
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE role = ? AND username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $role, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User authenticated, you can redirect or set a session here
        if($role=='admin'){
            header("location: admin.php");
            exit();
        }
        elseif($role=='teacher'){
            header("location: teacher.php");
        }
        if($role=='student'){
            header("location: student.php");
        }
    } else {
        // Invalid credentials
        echo "Invalid credentials. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
