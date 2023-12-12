<?php

session_start();
if (isset($_SESSION["username"]) && $_SESSION["role"])
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_ID = $_POST["course_ID"];
        $Name = $_POST["Name"];
        $department_ID=$_POST["Department_ID"];
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
    // Prepare and execute the SQL query to fetch other details
  $sql = "INSERT INTO courses Values('$course_ID','$Name','$department_ID')";
  $result = $conn->query($sql);
  
  
        header("Location: admin_courses.php");
    } else {
        echo'Failed to get details from the form';
    }
}
else
{
    header("Location: index.php");
}
?>