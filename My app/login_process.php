<?php
session_start();

$error = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = ""; // Password for XAMPP's MySQL root user
    $db_name = "student"; // Replace with your database name

    // Establish connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {

                if ($row['usertype'] === 'admin') {
                    $_SESSION['email']=$email;
                    $_SESSION["usertype"] = "admin";
                    header("Location: admin/admin_dashboard.php");
                    exit();
                } elseif ($row['usertype'] === 'student') {
                    $_SESSION['email']=$email;
                    $_SESSION["usertype"] = "student";
                    header("Location: student/student_dashboard.php");
                    exit();
                } elseif ($row['usertype'] === 'faculty') {
                    $_SESSION['email']=$email;
                    $_SESSION["usertype"] = "faculty";
                    header("Location: faculty/faculty_dashboard.php");
                    exit();
                }
            } else {
                $Message = "Invalid credentials";
                header("Location: login.php?Message=".$Message);
                
            }
        } else {
            $error = "User not found";
        }
    }

    $conn->close();
}
?>