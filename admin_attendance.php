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
      justify-content: space-between;
    }
    .grid-item {
            height: 290px;
            width: 290px;
            display: grid;
            grid-template-rows: repeat(4, 1fr);
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

        .subject-box {
        display: inline-block;
        margin: 10px;
        height: 280px;
        width: 280px;
        border: 3px solid black;
        text-decoration: none;
        color: black;
        transition: background-color 0.3s; /* Smooth transition for color change */
        border-radius: 25px;
        text-align: center;
    }

    .subject-box:hover {
        background-color: #CC9933; /* Change the background color on hover */
    }

    .subject-box .grid {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
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
            <a class="active" href="admin_attendance.php">
            <span class="icon"><ion-icon name="clipboard-outline"></ion-icon></span>
            <span class="title">Attendance</span>
            </a>
        </li>
        <li>
            <a href="admin_teachers.php">
            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
            <span class="title">Teachers</span>
            </a>
        </li>
        <li>
            <a href="admin_students.php">
            <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
            <span class="title">Students</span>
            </a>
        </li>
        <li>
            <a href="admin_departments.php">
            <span class="icon"><ion-icon name="business-outline"></ion-icon></span>
            <span class="title">Department</span>
            </a>
        </li>
        <li>
            <a href="admin_courses.php">
            <span class="icon"><ion-icon name="clipboard-outline"></ion-icon></span>
            <span class="title">Courses</span>
            </a>
        </li>
        <li>
            <a href="admin_classes.php">
            <span class="icon"><ion-icon name="pencil-outline"></ion-icon></span>
            <span class="title">Classes</span>
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
echo'
<div style="width:1210px; height:100px; border:3px solid black;" class="px-3 py-1">
<p class="text-xl">Filter Classes:</p>
<div class="grid grid-cols-3">
<div>
<label for="classFilter">Class:</label>
    <select style="width:300px;" id="classFilter" onchange="filterSubjects()">
        <option value="">All Classes</option>';
        
        // Fetch distinct classes from the subjects table
        $classQuery = "SELECT DISTINCT Class FROM subjects";
        $classResult = $conn->query($classQuery);
        while ($classRow = $classResult->fetch_assoc()) {
            echo '<option value="' . $classRow['Class'] . '">' . $classRow['Class'] . '</option>';
        }
    echo'
    </select>
</div>
<div>
<label for="courseFilter">Course:</label>
<select style="width:300px;" id="courseFilter" onchange="filterSubjects()">
    <option value="">All Courses</option>
    ';
    // Fetch distinct courses from the courses table
    $courseQuery = "SELECT * FROM courses";
    $courseResult = $conn->query($courseQuery);
    while ($courseRow = $courseResult->fetch_assoc()) {
        echo '<option value="' . $courseRow['Name'] . '">' . $courseRow['Name'] . '</option>';
    }
    echo'
    </select>
</div>
<div>

</div>
</div>
</div> <br>
';

$sql = "SELECT subjects.Subject_ID, subjects.Subject_Name, subjects.Class, courses.Name FROM subjects,courses where courses.Course_ID = subjects.Course_ID";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo '
      <a href="attendance_details.php?Subject_ID=' . $row['Subject_ID'] . '" class="subject-box" data-class="' . $row['Class'] . '" data-course="' . $row['Name'] . '">
          <div class="grid grid-rows-3">
              <div>
                  <div class="text-2xl"><b>' . $row['Subject_Name'] . '</b></div>
                  <div class="text-l">Course: ' . $row['Name'] . ' </div>
                  <div class="text-l">Class: ' . $row['Class'] . '</div>
              </div>
          </div>
      </a>
  ';
}

?>
</div>
<script>
function filterSubjects() {
    var classFilter = document.getElementById('classFilter').value;
    var courseFilter = document.getElementById('courseFilter').value;

    var subjects = document.querySelectorAll('.subject-box');
    subjects.forEach(function (subject) {
        var subjectClass = subject.getAttribute('data-class');
        var subjectCourse = subject.getAttribute('data-course');

        var showSubject = (classFilter === '' || classFilter === subjectClass) &&
            (courseFilter === '' || courseFilter === subjectCourse || courseFilter === 'All Courses');

        subject.style.display = showSubject ? 'inline-block' : 'none';
    });
}
</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>