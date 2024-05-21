<?php
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['email']) || $_SESSION['usertype'] != 'student') {
    header("location: ../login.php");
    exit(); // Ensure script stops executing after redirection
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in student's email
$email = $_SESSION['email'] ?? '';
if (!empty($email)) {
    // Retrieve the module name from the form submission
    if (isset($_POST['enroll']) && isset($_POST['module_name'])) {
        $moduleName = $_POST['module_name'];

        // Check if the student is already enrolled in this module
        $enrollmentCheckQuery = "SELECT * FROM enrollments WHERE student_email = '$email' AND module_name = '$moduleName'";
        $enrollmentCheckResult = $conn->query($enrollmentCheckQuery);

        if ($enrollmentCheckResult && $enrollmentCheckResult->num_rows > 0) {
            echo "You are already enrolled in this module.";
        } else {
            // Proceed with enrollment
            $enrollQuery = "INSERT INTO enrollments (student_email, module_name) VALUES ('$email', '$moduleName')";
            if ($conn->query($enrollQuery) === TRUE) {
                echo '<script>alert("Enrollment Success");</script>';
                header("Location: {$_SERVER['HTTP_REFERER']}"); // Redirect back to the previous page
                exit();
            } else {
                echo "Error enrolling: " . $conn->error;
            }
        }
    }
} else {
    echo "Email not found.";
}

$conn->close();
?>
