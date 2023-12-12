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
            <a class="active" href="admin_teachers.php">
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
  // Prepare and execute the SQL query to fetch other details
 $sql = "SELECT teachers.Teacher_ID, teachers.Full_Name, teachers.Date_of_Joining , department.Department_Name FROM teachers,department WHERE department.Department_ID=teachers.Department_ID";
 $result = $conn->query($sql);    
 $sql2="SELECT distinct Department_Name FROM department";
 $result2 = $conn->query($sql2);
 
     if (isset($_SESSION["username"]) && isset($_SESSION["role"])) 
     {
         echo
         '
         <div style="width:1220px; height:100px; border: 3px solid black; padding:10px;" class="filter-section">
         <p class="text-xl">Filter Teachers<p>
         <div class="grid grid-cols-3">
         <div>
     <label for="filterName">Name:</label>
     <input style="width:300px;" type="text" id="filterName" name="filterName" oninput="filterTable()" />
     
     </div>
     <div>
     <label for="filterDepartment">Department:</label>
     <select style="width:300px;" type="text" id="filterDepartment" name="filterDepartment" oninput="filterTable()" />
     <option></option>';
 while($row2 = $result2->fetch_assoc()){
     echo'<option>' . $row2['Department_Name'] . '</option>';
 }
     echo'</select>
     </div>
 
     <div>
     <label for="filterYear">Year:</label>
     <input type="text" style="width:300px;" type="text" id="filterYear" name="filterYear" oninput="filterTable()" />
     </div>
 </div>
 <br><br>
 <center>
         <table border="1" style="border-collapse: collapse; width: 100%;">
         <tr>
         <th style="border: 4px solid black; padding: 8px;" class="text-2xl">ID</th>
         <th style="border: 4px solid black; padding: 8px;" class="text-2xl"> Name</th>
         <th style="border: 4px solid black; padding: 8px;" class="text-2xl">Year of Joining</th>
         <th style="border: 4px solid black; padding: 8px;" class="text-2xl">Department</th>
         <th style="border: 4px solid black; padding: 8px;" class="text-2xl">Delete</th>
         </tr>
         ';
         while($row= $result->fetch_assoc()){
             echo
             '
             <tr>
             <td style="border: 2px solid black; padding: 10px;">' . $row["Teacher_ID"] . '</td>
             <td style="border: 2px solid black; padding: 10px;">' . $row["Full_Name"] . '</td>
             <td style="border: 2px solid black; padding: 10px;">' . $row["Date_of_Joining"] . '</td>
             <td style="border: 2px solid black; padding: 10px;">' . $row["Department_Name"] . '</td>
             <td style="border: 2px solid black; padding: 10px;"><center><a href="remove_teacher.php?Teacher_ID=' . $row['Teacher_ID'] . '" class="button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 items-center">Delete</a></center></td>
             </tr>
             ';
         }
         echo'</table><br><br>';
 }
  ?>
</div>
<script>
    function filterTable() {
        // Get input values
        var filterName = document.getElementById("filterName").value.toUpperCase();
        var filterDepartment = document.getElementById("filterDepartment").value.toUpperCase();
        var filterYear = document.getElementById("filterYear").value.toUpperCase();

        // Get the table rows
        var rows = document.querySelectorAll("table tr");

        // Loop through each row and hide/show based on the input values
        for (var i = 1; i < rows.length; i++) {
            var name = rows[i].cells[1].textContent.toUpperCase();
            var course = rows[i].cells[3].textContent.toUpperCase();
            var classValue = rows[i].cells[2].textContent.toUpperCase();

            if (name.includes(filterName) && course.includes(filterDepartment) && classValue.includes(filterYear)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>