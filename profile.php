<?php
// Start the session
session_start();

// Check if the username is set in the session
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
    $sql = "SELECT role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch and display the user details
        $row = $result->fetch_assoc();
    if ($row["role"] == "admin") {
        $sql = "SELECT Profile_Pic FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the profile picture path
        $row = $result->fetch_assoc();
        
        $profilePictureBinary = $row['Profile_Pic'];

        // Convert binary data to base64
        $profilePictureBase64 = base64_encode($profilePictureBinary);

        
        // Display the profile picture
        echo '<div class="navbar-horizontal">
                <ul>
                    <li>
                        <a href="profile.php">
                            <div class="grid grid-cols-2">
                                <span><img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"></span>
                                <div class="grid grid-rows-3">
                                    <div></div>
                                    <span href="profile.php">Profile</span>
                                    <div></div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>';
    } 
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

    } 
    elseif($row["role"] == "teacher") {
        
        $sql = "SELECT Profile_Pic FROM teachers WHERE username = '$username'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Fetch the profile picture path
            $row = $result->fetch_assoc();
            
            $profilePictureBinary = $row['Profile_Pic'];
    
            // Convert binary data to base64
            $profilePictureBase64 = base64_encode($profilePictureBinary);
    
            
            // Display the profile picture
            echo '<div class="navbar-horizontal">
                    <ul>
                        <li>
                            <a href="profile.php">
                                <div class="grid grid-cols-2">
                                    <span><img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"></span>
                                    <div class="grid grid-rows-3">
                                        <div></div>
                                        <span href="profile.php">Profile</span>
                                        <div></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>';
        } 
    elseif($row["role"] == "student") {
        $sql = "SELECT Profile_Pic FROM students WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the profile picture path
        $row = $result->fetch_assoc();
        
        $profilePictureBinary = $row['Profile_Pic'];

        // Convert binary data to base64
        $profilePictureBase64 = base64_encode($profilePictureBinary);

        
        // Display the profile picture
        echo '<div class="navbar-horizontal">
                <ul>
                    <li>
                        <a href="profile.php">
                            <div class="grid grid-cols-2">
                                <span><img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"></span>
                                <div class="grid grid-rows-3">
                                    <div></div>
                                    <span href="profile.php">Profile</span>
                                    <div></div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>';
    } 
    }

    $conn->close();
    }
}
}
else {
    // Redirect if the username is not set in the session
    header("Location: login.html");
    exit();
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <title>User Profile</title>
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
    </style>
</head>
<body>
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
            <a class="active" href="javascript:history.go(-1);">
            <ion-icon name="chevron-back-outline"></ion-icon>
            <span class="title">Back</span>
            </a>
        </li>
        <li>
            <a href="index.html">
            <ion-icon name="log-out-outline"></ion-icon>
            <span class="title">Log Out</span>
            </a>
        </li>
    </ul>
    </div>
<div class="content">
  <!-- Your main content goes here -->
  <?php
  // Check if the username is set in the session
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
    $sql = "SELECT role FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch and display the user details
        $row = $result->fetch_assoc();
    if ($row["role"] == "admin") {
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Fetch and display the user details
            $row = $result->fetch_assoc();
            $fullName=$row['Full_Name'];
            $email=$row['Email'];
            $phone= $row['Phone'];

            echo"<center><p class='text-2xl'>Welcome <b>". $row["Full_Name"]. "</b></p></center>";
            echo"<br>";
        
            echo' <div class="grid grid-cols-3">
            <div style="height:500px; width:400px; "class="max-w-sm bg-white border border-gray-200">
            <br>
                    <center>
                    <p class="text-xl">Update Profile Picture</p>
                    <br>
                    <img style="height:260px; width:260px;" src="data:image/jpeg;base64,' . $profilePictureBase64 . '"/></center>
                <div class="p-5">
                <form action="upload_profile_pic.php" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_pic" accept="image/*">
                <br><br>
                <center><input type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Upload"></center>
            </form>
                </div>
            </div>
            <div style="height:500px; width:400px; "class="max-w-sm bg-white border border-gray-200">
            <div class="p-5">
            <center>
            <p class="text-xl">Update Details</p><br></center>
            <form action="update_details.php" method="post">
                            <label for="fullName">Full Name:</label><br>
                            <input type="text" id="fullName" name="fullName" value="' . $fullName . '" required>
                            <br><br>

                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email" value="' . $email . '" required>
                            <br><br>

                            <label for="phone">Phone:</label><br>
                            <input type="tel" id="phone" name="phone" value="' . $phone . '" required>
                            <br><br>

                            <label for="username">Username:</label><br>
                            <input type="text" id="username" name="username" value="' . $username . '" disabled>
                            <br><br>

                            <input type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Update Details">
                        </form>
            </div>
            </div>
            <div style="height:500px; width:400px; "class="max-w-sm bg-white border border-gray-200">
            <div class="p-5">
            <p class="text-xl">Update Password</p><br>
            <form action="update_password.php" method="post">
                            <label for="password">Password</label><br>
                            <input type="password" id="password" name="password" required>
                            <br><br>

                            <label for="conpassword">Confirm Password:</label><br>
                            <input type="password" id="conpassword" name="conpassword" required>
                            <br><br>

                            <input type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Update Password">
                        </form></center>
                    </div>
            </div>
            </div>
            </div>
            </div>
            ';
        }
    }
    elseif ($row["role"] == "teacher") {
    
    }
    elseif ($row["role"] == "student") {
    
    }
    }
}
  ?>
</div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>