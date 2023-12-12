
<?php

session_start();
if (isset($_SESSION["username"]) && $_SESSION["role"])
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Subject_ID = $_POST["Subject_ID"];
        $Subject_Name = $_POST["Subject_Name"];
        $Course_ID=$_POST["Course_ID"];
        $class=$_POST["class"];
        $Teacher_ID = $_POST["Teacher_ID"];

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
  $sql = "INSERT INTO subjects Values('$Subject_ID','$Subject_Name','$class','$Course_ID','$Teacher_ID')";
  $result = $conn->query($sql);

  if($class=="Year 1" || $class=="year 1"){
    $sql = "CREATE TABLE `$Subject_ID` (
        Student_ID VARCHAR(50) PRIMARY KEY,
        Full_Name VARCHAR(255),
        `22-10-2023` VARCHAR(30),
        `23-10-2023` VARCHAR(30),
        `29-10-2023` VARCHAR(30),
        `30-10-2023` VARCHAR(30),
        `05-11-2023` VARCHAR(30),
        `06-11-2023` VARCHAR(30),
        `12-11-2023` VARCHAR(30),
        `13-11-2023` VARCHAR(30),
        `19-11-2023` VARCHAR(30),
        `20-11-2023` VARCHAR(30),
        `26-11-2023` VARCHAR(30),
        `27-11-2023` VARCHAR(30),
        `03-12-2023` VARCHAR(30),
        `04-12-2023` VARCHAR(30),
        `10-12-2023` VARCHAR(30),
        `11-12-2023` VARCHAR(30),
        `17-12-2023` VARCHAR(30),
        `18-12-2023` VARCHAR(30)
    )";
    
    $result = $conn->query($sql);

    $sql2="SELECT Student_ID, Full_Name from students WHERE Class='$class' and Course_ID='$Course_ID'";
    $result2 = $conn->query($sql2);
    while($row2= $result2->fetch_assoc()) {
        $student_ID= $row2["Student_ID"];
        $student_Name= $row2["Full_Name"];
        $sql3="INSERT INTO `$Subject_ID`(Student_ID,Full_Name) VALUES('$student_ID','$student_Name')";
        $result3 = $conn->query($sql3);
    }
    $sql3 = "ALTER TABLE `$Subject_ID`
    ADD CONSTRAINT " . "fk_student_id_$Subject_ID" . "
    FOREIGN KEY (Student_ID)
    REFERENCES students(Student_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE";

    $result3 = $conn->query($sql3);

    header("Location: admin_classes.php");
  }
elseif($class=="Year 2" || $class=="year 2"){
    $sql="CREATE TABLE `$Subject_ID` (
        Student_ID VARCHAR(50) PRIMARY KEY,
        Full_Name VARCHAR(255),
        `24-10-2023` VARCHAR(30),
        `25-10-2023` VARCHAR(30),
        `31-10-2023` VARCHAR(30),
        `01-10-2023` VARCHAR(30),
        `07-11-2023` VARCHAR(30),
        `08-11-2023` VARCHAR(30),
        `14-11-2023` VARCHAR(30),
        `15-11-2023` VARCHAR(30),
        `21-11-2023` VARCHAR(30),
        `22-11-2023` VARCHAR(30),
        `28-11-2023` VARCHAR(30),
        `29-11-2023` VARCHAR(30),
        `05-12-2023` VARCHAR(30),
        `06-12-2023` VARCHAR(30),
        `12-12-2023` VARCHAR(30),
        `13-12-2023` VARCHAR(30),
        `19-12-2023` VARCHAR(30),
        `20-12-2023` VARCHAR(30)
    )";
    $result = $conn->query($sql);

    $sql2="SELECT Student_ID, Full_Name from students WHERE Class='$class' and Course_ID='$Course_ID'";
    $result2 = $conn->query($sql2);
    while($row2= $result2->fetch_assoc()) {
        $student_ID= $row2["Student_ID"];
        $student_Name= $row2["Full_Name"];
        $sql3="INSERT INTO `$Subject_ID`(Student_ID,Full_Name) VALUES('$student_ID','$student_Name')";
        $result3 = $conn->query($sql3);
    }

    $sql3 = "ALTER TABLE `$Subject_ID`
    ADD CONSTRAINT " . "fk_student_id_$Subject_ID" . "
    FOREIGN KEY (Student_ID)
    REFERENCES students(Student_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE";

    $result3 = $conn->query($sql3);
    
    header("Location: admin_classes.php");
}
elseif($class=="Year 3" || $class=="year 3"){
    $sql="CREATE TABLE `$Subject_ID` (
        Student_ID VARCHAR(50) PRIMARY KEY,
        Full_Name VARCHAR(255),
        `26-10-2023` VARCHAR(30),
        `27-10-2023` VARCHAR(30),
        `02-11-2023` VARCHAR(30),
        `03-11-2023` VARCHAR(30),
        `09-11-2023` VARCHAR(30),
        `10-11-2023` VARCHAR(30),
        `16-11-2023` VARCHAR(30),
        `17-11-2023` VARCHAR(30),
        `23-11-2023` VARCHAR(30),
        `24-11-2023` VARCHAR(30),
        `30-11-2023` VARCHAR(30),
        `01-12-2023` VARCHAR(30),
        `07-12-2023` VARCHAR(30),
        `08-12-2023` VARCHAR(30),
        `14-12-2023` VARCHAR(30),
        `15-12-2023` VARCHAR(30),
        `21-12-2023` VARCHAR(30),
        `22-12-2023` VARCHAR(30)
    )
    ";
    $result = $conn->query($sql);

    $sql2="SELECT Student_ID, Full_Name from students WHERE Class='$class' and Course_ID='$Course_ID'";
    $result2 = $conn->query($sql2);
    while($row2= $result2->fetch_assoc()) {
        $student_ID= $row2["Student_ID"];
        $student_Name= $row2["Full_Name"];
        $sql3="INSERT INTO `$Subject_ID`(Student_ID,Full_Name) VALUES('$student_ID','$student_Name')";
        $result3 = $conn->query($sql3);
    }

    $sql3 = "ALTER TABLE `$Subject_ID`
    ADD CONSTRAINT " . "fk_student_id_$Subject_ID" . "
    FOREIGN KEY (Student_ID)
    REFERENCES students(Student_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE";

    $result3 = $conn->query($sql3);
    
    header("Location: admin_classes.php");
}
  
    } else {
        echo'Failed to get details from the form';
    }
}
else
{
    header("Location: index.php");
}
?>