<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobileNumber = $_POST['phone'] ?? '';
    $password=$_POST['password'] ?? '';
    // Validate mobile number length
    if (strlen($mobileNumber) !== 10) {
        $error = "Mobile number should be 10 digits only.";
        header("Location: profile.php?error=" . urlencode($error));
        exit();
    }

    if(strlen($password)==0)
    {
        $error = "Password required.";
        header("Location: profile.php?error=" . urlencode($error));
        exit();
    }
    // Update mobile number in the database (adjust this based on your database connection and schema)
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve email from the session
    $email = $_SESSION['email'] ?? '';

    // Update mobile number in the students table
    $updateSQL1 = "UPDATE students SET phone = '$mobileNumber', password='$password' WHERE email = '$email'";
    $updateSQL2 = "UPDATE users SET  password='$password' WHERE email = '$email'";
    if (($conn->query($updateSQL1) === TRUE)&&($conn->query($updateSQL2) === TRUE)) {
        // Mobile number updated successfully, redirect back to profile.php
       echo '<script>alert("Your Profile has been updated successfully.");</script>';
        echo '<script>window.location.href = "student_dashboard.php";</script>';
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: error.php"); // Handle situations when data is not received via POST method
    exit();
}
?>
