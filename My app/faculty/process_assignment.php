<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
    exit;
}

if ($_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_email = $_POST['student_email'] ?? '';
    $module_name = $_POST['module_name'] ?? '';
    $assignment_title = $_POST['assignment_title'] ?? '';
    $assignment_deadline = $_POST['assignment_deadline'] ?? '';
    $faculty_email = $_SESSION['email'] ?? '';
    // Perform necessary validation on form inputs before proceeding to database operations
    // Check for empty fields
    if (empty($student_email) || empty($module_name) || empty($assignment_title) || empty($assignment_deadline)) {
        // Handle error: Some fields are empty
        echo "Please fill in all fields.";
        exit;
    }

    // Perform additional validation as needed
    // Example: Date validation
    if (strtotime($assignment_deadline) < time()) {
        // Handle error: Assignment deadline is in the past
        echo "Assignment deadline must be in the future.";
        exit;
    }

    // Example: Insert assignment data into a table named 'assignments'
    $insertAssignmentQuery = "INSERT INTO assignments (faculty_email, student_email, module_name, assignment_title, assignment_deadline)
                          VALUES ('$faculty_email', '$student_email', '$module_name', '$assignment_title', '$assignment_deadline')";

    if ($conn->query($insertAssignmentQuery) === TRUE) {
        // Assignment added successfully
        echo "<script>alert('Assignment added successfully');</script>";
        header("location: manage_students.php");
        exit;
    } else {
        // Error occurred while adding assignment
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
