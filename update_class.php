<head>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
        <title> Attendance Management System </title>
    </head>
    <style>
  body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .navbar-vertical {
      height: 100%;
      width: 260px;
      background-color: #4169e1;
      position: fixed;
      left: 0;
      top: 0;
      overflow-x: hidden;
      padding-top: 20px;
       z-index: 1;
    }

    .navbar-vertical a {
      padding: 20px;
      text-decoration: none;
      font-size: 20px;
      color: white;
      display: block;
    }

    .navbar-vertical a:hover {
      background-color: #D4AF37;
    }
    .active {
      background-color: #D4AF37;
    }

    .navbar-vertical li {
      list-style: none; 
    }

    .navbar-horizontal {
      background-color: #4169e1;
      overflow: hidden;
      position: fixed;
      top: 0;
      width: 100%;
      padding-top: 1px;
      padding-bottom: 1px;
      padding-right: 15px;
    }

    .navbar-horizontal a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 10px;
      text-decoration: none;
      font-size: 20px;
      color: white;
      display: block;
    }

 .navbar-horizontal li {
      list-style: none; 
      float: right;
    }
    .content {
      margin-left: 265px;
      padding: 20px;
      margin-top: 70px; /* Adjust this value to leave space for the horizontal navbar */
    }
    .grid-item {
            height: 290px;
            width: 290px;
            display: grid;
            grid-template-rows: repeat(3, 1fr);
            border: 4px solid #000; /* Adjust the border color */
            border-radius : 25px ;
        }
    .grid-item:hover{
      background-color:#4169e1 ; 
      } 

        .grid-item p {
            text-align: center;
            font-size: 4xl;
        }

        .grid-item b {
            font-size: 2xl;
        }
    </style>
  <body>
    <?php
    // Start the session
    session_start();

    // Check if session variables are set
    if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        // Fetch profile picture from the database
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

    // Prepare and execute the SQL query to fetch the profile picture
    $sql = "SELECT profile_pic FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the profile picture path
        $row = $result->fetch_assoc();
        $profilePictureBinary = $row['profile_pic'];

        // Convert binary data to base64
        $profilePictureBase64 = base64_encode($profilePictureBinary);
        // Display the profile picture
        echo '<div class="navbar-horizontal">
                <ul>
                    <li>
                        <a>
                            <div class="grid grid-cols-2">
                                <span><img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"></span>
                                <div class="grid grid-rows-3">
                                    <div></div>
                                    <a href="profile.php">Profile</a>
                                    <div></div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>';
    } else {
        echo "Profile picture not found.";
    }
      

    } else {
        // Redirect if session variables are not set
        header("Location: login.php");
        exit();
    }
    ?>
    
  <div class="navbar-vertical">
    <ul>
        <li>
            <div style="color: white; font-size:30px;">
            <span class="icon"><ion-icon name="flash-outline"></ion-icon></span>
            <span class="title"><b>Bolton AMS</b></span>
            </div>
        </li>
        <br>
        <li>
            <a href="admin.php">
            <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
            <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="active" href="javascript:history.go(-1);">
            <ion-icon name="chevron-back-outline"></ion-icon>
            <span class="title">Back</span>
            </a>
        </li>
        <li>
            <a href="index.php">
            <ion-icon name="log-out-outline"></ion-icon>
            <span class="title">Log Out</span>
            </a>
        </li>
    </ul>
    </div>
<div class="content">
  <!-- Your main content goes here -->
 <?php
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
    if(isset($_GET['Subject_ID'])) {
        $Subject_ID = $_GET['Subject_ID'];
    // Prepare and execute the SQL query to fetch other details  
  
  $sql="SELECT * FROM subjects WHERE Subject_ID = '$Subject_ID'";
  $result = $conn->query($sql);
  $row= $result->fetch_assoc();
  $Subject_Name=$row['Subject_Name'];
  $class=$row['Class'];
  $Course_ID= $row['Course_ID'];
  $Teacher_ID=$row['Teacher_ID'];

  $sql="SELECT Full_Name FROM teachers where Teacher_ID='$Teacher_ID'";
  $result = $conn->query($sql);
  $row= $result->fetch_assoc();
  $teacher= $row["Full_Name"];

  $sql="SELECT Name FROM courses where Course_ID='$Course_ID'";
  $result = $conn->query($sql);
  $row= $result->fetch_assoc();
  $course= $row["Name"];

  $sql2 = "SELECT Student_ID, Full_Name FROM $Subject_ID";
  $result2 = $conn->query($sql2);
  
echo
'
<center>
<div style="height:270px; width:1000px;" class="border border-gray-200">
<br>
<p class="text-2xl"><b>'.$Subject_Name.'</b></p>
<br>
<dic class="grid grid-cols-2">
<div>
        <label for="Subject_ID">Subject ID</label><br>
        <input type="text" id="Subject_ID" name="Subject_ID" style="width:330px;" value="' . $Subject_ID . '" disabled>
        <br><br>

        <label for="class">Class:</label><br>
        <input type="text" id="class" name="class" style="width:330px;" value="' . $class . '" disabled>
        <br><br>

</div>
<div>


        <label for="class">Course:</label><br>
        <input type="text" id="course" name="course" style="width:330px;" value="' . $course . '" disabled>
        <br><br>

        <label for="teacher">Teacher</label><br>
        <input type="text" id="teacher" name="teacher" style="width:330px;" value="' . $teacher . '" disabled>
        <br><br>
</div>
</div>

<br>
<table border="1" style="border-collapse: collapse; width: 70%;">
<tr>
<th style="border: 2px solid black; padding: 6px;" class="text-xl">Student ID</th>
<th style="border: 2px solid black; padding: 6px;" class="text-xl">Name</th>
<th style="border: 2px solid black; padding: 6px;" class="text-xl">View</th>
<th style="border: 2px solid black; padding: 6px;" class="text-xl">Remove</th>
</tr>';

while($row2 = $result2->fetch_assoc()){
    echo'
    <tr>
<td style="border: 2px solid black; padding: 6px;">' . $row2['Student_ID'] . '</td>
<td style="border: 2px solid black; padding: 6px;">' . $row2['Full_Name'] . '</td>
<td style="border: 2px solid black; padding: 6px;"><center><a href="student_details.php?Student_ID='.$row2['Student_ID'].'" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View</a></center></td>
<td style="border: 2px solid black; padding: 6px;"><center><a href="expel.php?Student_ID='.$row2['Student_ID'].'&Subject_ID='.$Subject_ID.'" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Remove</a></center></td>
</tr>
    ';
}
echo'</table>
<br><br>
</center>
';   


    }}
 ?>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>