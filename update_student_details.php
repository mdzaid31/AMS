<!DOCTYPE html>
<html>
<body>

<?php
session_start();
if (isset($_SESSION["username"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['Student_ID'])) {
        $Student_ID = $_GET['Student_ID'];
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $course = $_POST["course"];
        $password = $_POST["password"];
        $conpassword = $_POST["conpassword"];
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $class = $_POST["class"];
        $susername = $_POST["username"];

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

        if ($password == $conpassword) {
            $sql = "SELECT Username FROM students WHERE Student_ID = '$Student_ID'";
            $result = $conn->query($sql);

            if ($result) {
                $row = $result->fetch_assoc();
                $username = $row["Username"];

                // Update users table
                $sql="SELECT Course_ID from courses where Name='$course'";
                $result = $conn->query($sql);
                $row2= $result->fetch_assoc();
                $Course_ID= $row2["Course_ID"];
    $sqlUsers = "UPDATE users SET Username='$susername', Password='$password' WHERE Username='$username'";
    $conn->query($sqlUsers);

// Update students table
$sqlStudents = "UPDATE students SET Full_Name='$fullName', 
    Age='$age', Email='$email', Phone='$phone', Class='$class', 
    Course_ID='$Course_ID', Username='$susername' WHERE Student_ID = '$Student_ID'";
$conn->query($sqlStudents);

                if ($_FILES["Profile_Pic"]["size"] > 0) {
                    $image = $_FILES["Profile_Pic"]["tmp_name"];
                    $imageData = file_get_contents($image);

                    $updateSql = "UPDATE students SET Profile_Pic = ? WHERE Username = '$susername'";
                    $updateStmt = $conn->prepare($updateSql);

                    // Use 'b' for a BLOB data type
                    $updateStmt->bind_param("s", $imageData);
                    $updateStmt->execute();
                    $updateStmt->close();
                }

                header('Location: modify_student.php?Student_ID='.$Student_ID.'');
                exit();
            } else {
                echo "Error retrieving data: " . $conn->error;
            }
        } else {
            echo 'Passwords Do not Match';
        }
    }
} else {
    header("Location: index.php");
}
?>

</body>
</html>
