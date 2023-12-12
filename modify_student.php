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
            <a href="admin_attendance.php">
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
            <a class="active" href="admin_students.php">
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
    // Prepare and execute the SQL query to fetch other details
    if(isset($_GET['Student_ID'])) {
        $Student_ID = $_GET['Student_ID'];
  $sql = "SELECT * FROM students where Student_ID ='$Student_ID'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $fullName=$row['Full_Name'];
  $age=$row['Age'];
  $phone=$row['Phone'];
  $email=$row['Email'];
  $class=$row['Class'];
  $susername=$row['Username'];
  $course_ID=$row['Course_ID'];
  $profilePictureBinary = $row['Profile_Pic'];

  // Convert binary data to base64
  $profilePictureBase64 = base64_encode($profilePictureBinary);

  $sql2="SELECT Password from users where Username='$susername'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();
  $password=$row2['Password'];

  $sql3="SELECT Name from courses where Course_ID='$course_ID'";
  $result3 = $conn->query($sql3);
  $row3 = $result3->fetch_assoc();
  $course= $row3["Name"];
  
}
}
echo
'
<center>
<div style="height:1000px; width:900px;" class="border border-gray-200">
<br>
<p class="text-xl">Update Student</p>
<form action="update_student_details.php?Student_ID=' . $Student_ID . '" method="POST" enctype="multipart/form-data">
<br>
<img style="height:260px; width:260px;" src="data:image/jpeg;base64,' . $profilePictureBase64 . '">
<br>
<input type="file" name="Profile_Pic" accept="image/*">
<br><br>
<div class="grid grid-cols-2">
<div class="p-5">
        <label for="student_ID">Student ID:</label><br>
        <input type="text" id="student_ID" name="student_ID" style="width:330px;" value="' . $Student_ID . '" disabled>
        <br><br>

        <label for="fullName">Full Name:</label><br>
        <input type="text" id="fullName" name="fullName" style="width:330px;" value="' . $fullName . '"  required>
        <br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" style="width:330px;" value="' . $email . '"  required>
        <br><br>

        <label for="course">Course:</label><br>
        <input type="text" id="course" name="course" style="width:330px;" value="' . $course . '">

<br><br>

        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password" style="width:330px;" value="' . $password . '"  required>
        <br><br>
</div>
<div class="p-5">
        <label for="age">Age:</label><br>
        <input type="text" id="age" name="age" style="width:330px;" value="' . $age . '"  required>
        <br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" style="width:330px;" value="' . $phone . '"  required>
        <br><br>

        <label for="class">Class:</label><br>
        <select id="class" name="class" style="width:330px;" required>
            <option value="' . $class . '">' . $class . '</option>';
        
        if ($class == "Year 1" || $class == "year 1") {
            echo '<option value="Year 2">Year 2</option>
                  <option value="Year 3">Year 3</option>';
        }
        if ($class == "Year 2" || $class == "year 2") {
            echo '<option value="Year 1">Year 1</option>
                  <option value="Year 3">Year 3</option>';
        }
        if ($class == "Year 3" || $class == "year 3") {
            echo '<option value="Year 1">Year 1</option>
                  <option value="Year 2">Year 2</option>';
        }
        
        
        echo'</select>
        <br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" style="width:330px;" value="' . $susername . '"  required>
        <br><br>

        <label for="conpassword">Confirm Password:</label><br>
        <input type="password" id="conpassword" name="conpassword" style="width:330px;" required>
        <br><br>
</div>
</div>
<input type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Update Student">
</form>
</div>
</center>
';     
 ?>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>