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
 
if(isset($_GET['Department_ID'])) {
        $Department_ID = $_GET['Department_ID'];
        $nDepartment_ID = $_POST['Department_ID'];
        $Department_Name = $_POST['Department_Name'];

        $sql="UPDATE department Set Department_ID='$nDepartment_ID', Department_Name='$Department_Name' where Department_ID='$Department_ID'";
        $result = $conn->query($sql);
        header("Location: update_department.php?Department_ID=$Department_ID");

}
 }
?>