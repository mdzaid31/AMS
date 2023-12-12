<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch other details from the database based on the username
    $servername = "localhost";
    $username_db = "zaid";
    $password_db = "1234";
    $dbname = "attendance";

    // Create connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $password = $_POST["password"];
        $conpassword = $_POST["conpassword"];
        if($conpassword == $password){
            $sql = "UPDATE users SET Password = '$password' WHERE Username = '$username'";
        
            if ($conn->query($sql) === TRUE) {
             header("Location: profile.php");
            } else {
                echo "Error updating details: " . $conn->error;
            }
        }
        else{
            echo"Passwords Do Not Match";
        }
        // Update the details in the database
    }

    $conn->close();
}
?>
