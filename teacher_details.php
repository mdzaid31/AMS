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
    if(isset($_GET['Teacher_ID'])) {
        $Teacher_ID = $_GET['Teacher_ID'];
    // Prepare and execute the SQL query to fetch other details  
  
  $sql="SELECT * FROM teachers WHERE Teacher_ID = '$Teacher_ID'";
  $result = $conn->query($sql);
  $row= $result->fetch_assoc();
  $fullName=$row['Full_Name'];
  $age=$row['Age'];
  $phone=$row['Phone'];
  $email=$row['Email'];
  $year=$row['Date_of_Joining'];
  $tusername=$row['Username'];
  $Department_ID=$row['Department_ID'];
  $profilePictureBinary = $row['Profile_Pic'];

  // Convert binary data to base64
  $profilePictureBase64 = base64_encode($profilePictureBinary);

  $sql2 = "SELECT Subject_ID, Subject_Name FROM subjects Where Teacher_ID='$Teacher_ID'";
  $result2 = $conn->query($sql2);
  
  $sql3 = "SELECT Department_Name from department where Department_ID='$Department_ID'";
  $result3 = $conn->query($sql3);
  $row3 = $result3->fetch_assoc();
  $department=$row3['Department_Name'];
echo
'
<center>
<div style="height:800px; width:900px;" class="border border-gray-200">
<br>
<img style="height:260px; width:260px;" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"/>
<div class="grid grid-cols-2">
<div class="p-5">
        <label for="Teacher_ID">Teacher ID:</label><br>
        <input type="text" id="Teacher_ID" name="Teacher_ID" style="width:330px;" value="' . $Teacher_ID . '" disabled>
        <br><br>

        <label for="fullName">Full Name:</label><br>
        <input type="text" id="fullName" name="fullName" style="width:330px;" value="' . $fullName . '" disabled>
        <br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" style="width:330px;" value="' . $email . '" disabled>
        <br><br>

        <label for="course">Department:</label><br>
        <input type="text" id="department" name="department" style="width:330px;" style="width:330px;" value="' . $department . '" disabled>
<br><br>

</div>
<div class="p-5">
        <label for="age">Age:</label><br>
        <input type="text" id="age" name="age" style="width:330px;" value="' . $age . '" disabled>
        <br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" style="width:330px;" value="' . $phone . '" disabled>
        <br><br>

        <label for="year">Year of Joining:</label><br>
        <input type="text" id="year" name="class" style="width:330px;" style="width:330px;" value="' . $year . '" disabled>
        <br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" style="width:330px;" value="' . $tusername . '" disabled>
        <br><br>

</div>
</div>
<table border="1" style="border-collapse: collapse; width: 70%;">
<tr>
<th style="border: 2px solid black; padding: 6px;" class="text-l">Subject ID</th>
<th style="border: 2px solid black; padding: 6px;" class="text-l">Subject Name</th>
</tr>';

while($row2 = $result2->fetch_assoc()){
    echo'
    <tr>
<td style="border: 2px solid black; padding: 6px;">' . $row2['Subject_ID'] . '</td>
<td style="border: 2px solid black; padding: 6px;">' . $row2['Subject_Name'] . '</td>
</tr>
    ';
}
echo'</table></div>
</center>
';   
    }}
 ?>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>