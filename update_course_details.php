<?php
session_start();

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
 
if(isset($_GET['Course_ID'])) {
        $Course_ID = $_GET['Course_ID'];
        $nCourse_ID = $_POST['Course_ID'];
        $Name = $_POST['Name'];

        $sql="UPDATE department Set Course_ID='$nCourse_ID', Name='$Name' where Course_ID='$Course_ID'";
        $result = $conn->query($sql);
        header("Location: update_course.php?Course_ID=$Course_ID");

}
 }
?>