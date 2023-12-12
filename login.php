<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.google.com/specimen/Orelega+One?query=ele">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css" integrity="sha512-W/zrbCncQnky/EzL+/AYwTtosvrM+YG/V6piQLSe2HuKS6cmbw89kjYkp3tWFn1dkWV7L1ruvJyKbLz73Vlgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <title>Attendance Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/main-css.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
   
    
    <link rel="stylesheet" href="assets/css/style.css" />


    <style>
        /* CSS RESET */

        .sub-header {
            margin-top: 1px;
            margin-left: 0%;
            margin-right: 0%;
            margin-bottom: 1%;
            border: 1px solid #000000;
            background-color: lightblue;
        }

        .inputBx select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-bottom: 2px solid #3498db; /* Add an underline effect */
        background-color: transparent;
        color: white;
        border-radius: 0;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        transition: border-bottom 0.3s ease-in-out;
      }
      .custom-border {
            border-bottom: 2px solid black; /* You can adjust the border thickness (4px) to your desired value. */
        }
        .custom-border2 {
            border-top: 2px solid black;
        }
    </style>
</head>

<body>
    <nav class="sub-header">
        <div class="max-w-screen-l flex flex-wrap items-center justify-between mx-auto p-2">
            <p class="flex items-center">
                <span class="self-center text-l font-semibold whitespace-nowrap dark:text-white">Made by Abdus, Abrar, Jawad, Mark and Zaid</span>
            </p>
        </div>
    </nav>

    <div class="header bg-white">
        <nav id="nav">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="index.html" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="aboutus.html" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About Us</a>
                </li>
                <li>
                    <a href="courses.html" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Courses</a>
                </li>
                <li>
                    <a href="services.html" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                </li>
                <li>
                    <a href="login.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Log in</a>
                </li>
                </ul>
        </nav>
        <span class="hamburger" id="button"><i class="fa-solid fa-bars"></i></span>
      </div>


      <!-- Move the login form content here -->
    <!-- Logo starts here -->
    <center>
        <br><br>
    <div class="square">
        <i style="--clr: #d3af37"></i>
        <i style="--clr: #191970"></i>
        <i style="--clr: #ffffff"></i>
        <div class="login">
            <h2>Login</h2>
            <form action="authentication.php" method="POST">
                <br>
            <div class="inputBx">
                <label for="role">Select Role:</label>
                <select id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
                <br><br>
            </div>
            <div class="inputBx">
                <input name ="username" id="username" type="text" placeholder="Username" />
            </div>
            <br>
            <div class="inputBx">
                <input id="password" name="password" type="password" placeholder="Password" />
            </div>
  <br>
            <div class="inputBx">
                <input type="submit" value="Sign in" />
            </div>
    </form>
            <div class="links">
                <a href="#">Forget Password</a>
            </div>
        </div>
      </div>
      <center>
</body>
</html>
