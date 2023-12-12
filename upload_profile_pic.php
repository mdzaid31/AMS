<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $image = $_FILES["profile_pic"]["tmp_name"];
        // Check if file upload is successful
        if ($_FILES["profile_pic"]["error"] !== UPLOAD_ERR_OK) {
            echo "File upload failed";
            exit();
        }

        // Read the file content and convert it to LONG BLOB binary form
        $imageData = file_get_contents($image);

        // Update the user's profile picture in the database
        $servername = "localhost";
        $username_db = "zaid";
        $password_db = "1234";
        $dbname = "attendance";

        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the user's profile picture in the database
        $updateSql = "UPDATE admin SET Profile_Pic = ? WHERE Username = '$username'";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("s", $imageData);
        $updateStmt->execute();
        $updateStmt->close();

        header("Location: profile.php");
    } else {
        echo "Session username not set.";
    }
} else {
    echo "Invalid request.";
}
?>