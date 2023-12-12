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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve values from the form
        $subjectID = $_POST["Subject_ID"];
        $attendanceDate = $_POST["attendanceDate"];
        $attendanceData = $_POST["attendance"];

        // Loop through the attendance data and update the database
        foreach ($attendanceData as $studentName => $attendanceStatus) {
            // Update the SubjectID table with the attendance status
            $sqlUpdate = "UPDATE $subjectID SET `$attendanceDate` = '$attendanceStatus' WHERE Full_Name = '$studentName'";
            $conn->query($sqlUpdate);
        }

        // Close the database connection
        $conn->close();

        // Redirect to a success page or perform other actions as needed
        header("Location: attendance_details.php?Subject_ID=".$subjectID."");
        exit();
    }
} else {
    // Redirect if the username is not set in the session
    header("Location: login.html");
    exit();
}
?>
