<?php
session_start();

if (isset($_SESSION['username']) && isset($_GET['Teacher_ID'])) {
    $Teacher_ID = $_GET['Teacher_ID'];
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


        $fullName = $_POST["fullName"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $tusername = $_POST["username"];
        $password = $_POST["password"];
        $year= $_POST["year"];
        $conpassword=$_POST["conpassword"];

     
        if($password == $conpassword){
            $sql="SELECT Username from teachers where Teacher_ID='$Teacher_ID'";
            $result = $conn->query($sql);
            $row= $result->fetch_assoc();
            $tempusername= $row["Username"];

            $sql="UPDATE users SET Username = '$tusername' , Password='$password' WHERE role='teacher' and Username='$tempusername'";
            $result = $conn->query($sql);

        // SQL query to update teacher details
        $sqlUpdateTeacher = "UPDATE teachers SET
                             Full_Name = '$fullName',
                             Age = '$age',
                             Phone = '$phone',
                             Email = '$email',
                             Username = '$tusername',
                             Date_of_Joining = '$year'
                             WHERE Teacher_ID = '$Teacher_ID'";
                             $resultUpdateTeacher = $conn->query($sqlUpdateTeacher);
                            
                            if ($_FILES["Profile_Pic"]["size"] > 0) {
                                $image = $_FILES["Profile_Pic"]["tmp_name"];
                                $imageData = file_get_contents($image);
            
                                $updateSql = "UPDATE teachers SET Profile_Pic = ? WHERE Username = '$tusername'";
                                $updateStmt = $conn->prepare($updateSql);
            
                                // Use 'b' for a BLOB data type
                                $updateStmt->bind_param("s", $imageData);
                                $updateStmt->execute();
                                $updateStmt->close();
                            }
                            header("Location: modify_teacher.php?Teacher_ID=$Teacher_ID");
                                exit();
        }
    else{
        echo "Passwords do not match";
    }
}
}