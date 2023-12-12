<html>
    <body>
    <?php
    session_start();
    if (isset($_SESSION["username"]) && $_SESSION["role"])
    {
        if(isset($_GET['Student_ID'])) 
        {
            $Student_ID = $_GET['Student_ID'];
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
            $sql="SELECT Username FROM students WHERE Student_ID = '$Student_ID'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $susername=$row['Username'];
                $sql2="DELETE fROM users where Username='$susername'";
                $result2 = $conn->query($sql2);

                $sql3="DELETE from students where Student_ID='$Student_ID'";
                $result3 = $conn->query($sql3);
                header("Location: delete_students.php");
                exit();
            }
        }    
    }
    ?>
    </body>
</html>