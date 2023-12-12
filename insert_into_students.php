<html>
<body>
<?php
session_start();
if (isset($_SESSION["username"]) && $_SESSION["role"])
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_ID = $_POST["student_ID"];
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $course = $_POST["course"];
        $password = ($_POST["password"]);
        $conpassword = ($_POST["conpassword"]); // encryption
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
    // Prepare and execute the SQL query to fetch other details
  $sql = "INSERT INTO users Values('$susername','$password','student')";
  $result = $conn->query($sql);
  
  $sql = "INSERT INTO students(Student_ID, Full_Name, Age, Email, Phone, Class, Course_ID,Username) 
  VALUES ('$student_ID','$fullName','$age','$email','$phone','$class','$course','$susername')";
  $result = $conn->query($sql);
  
  $sql2 = "SELECT Subject_ID FROM subjects Where Class='$class' and Course_ID='$course'";
  $result2 = $conn->query($sql2);

while($row2 = $result2->fetch_assoc()){
    $subject= $row2["Subject_ID"];
    $sql="INSERT into $subject (Student_ID, Student_Name) VALUES ('$student_ID','$fullName')";
    $result = $conn->query($sql);
}


  $image = $_FILES["profile_pic"]["tmp_name"];
        // Check if file upload is successful
        if ($_FILES["profile_pic"]["error"] !== UPLOAD_ERR_OK) {
            echo "File upload failed";
            exit();
        }

        // Read the file content and convert it to LONG BLOB binary form
        $imageData = file_get_contents($image);
        $updateSql = "UPDATE students SET Profile_Pic = ? WHERE Username = '$susername'";
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