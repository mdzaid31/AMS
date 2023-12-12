<html>
<body>
<?php
session_start();
if (isset($_SESSION["username"]) && $_SESSION["role"])
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $teacher_ID = $_POST["Teacher_ID"];
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $department = $_POST["department"];
        $password = ($_POST["password"]);
        $conpassword = ($_POST["conpassword"]); // encryption
        $age = $_POST["age"];
        $phone = $_POST["phone"];
        $year = $_POST["year"];
        $tusername = $_POST["username"];
        
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
  $sql = "INSERT INTO users Values('$tusername','$password','teacher')";
  $result = $conn->query($sql);
  
  $sql = "INSERT INTO teachers(Teacher_ID, Full_Name, Age, Email, Phone, Date_of_Joining, Department_ID,Username) 
  VALUES ('$teacher_ID','$fullName','$age','$email','$phone','$year','$department','$tusername')";
  $result = $conn->query($sql);
  


  $image = $_FILES["profile_pic"]["tmp_name"];
        // Check if file upload is successful
        if ($_FILES["profile_pic"]["error"] !== UPLOAD_ERR_OK) {
            echo "File upload failed";
            exit();
        }

        // Read the file content and convert it to LONG BLOB binary form
        $imageData = file_get_contents($image);
        $updateSql = "UPDATE teachers SET Profile_Pic = ? WHERE Username = '$tusername'";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $imageData);
        $updateStmt->execute();
        $updateStmt->close();

        header("Location: admin_students.php");
    } else {
        echo'Failed to get details from the form';
    }
}
else
{
    header("Location: index.php");
}
?>
</body>
</html>