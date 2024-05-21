<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$facultyEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['assignment_id']) && isset($_POST['student_email']) && isset($_POST['module_name']) && isset($_POST['assignment_title']) && isset($_POST['marks'])) {
        $assignmentId = $_POST['assignment_id'];
        $studentEmail = $_POST['student_email'];
        $moduleName = $_POST['module_name'];
        $assignmentTitle = $_POST['assignment_title'];
        $marks = $_POST['marks'];

        // Validate marks - should be between 0 and 100
        if ($marks < 0 || $marks > 100) {
            echo "<script>alert('Marks should be between 0 and 100.');</script>";
            echo '<script>window.location.href = "view_submission.php";</script>';
            exit();
        }

        // Check if marks exist for the assignment
        $checkMarksSql = "SELECT * FROM student_marks WHERE id = '$assignmentId'";
        $result = $conn->query($checkMarksSql);

        if ($result && $result->num_rows > 0) {
            // Update existing marks
            $updateSql = "UPDATE student_marks SET marks = '$marks' WHERE id = '$assignmentId'";
            if ($conn->query($updateSql) === TRUE) {
                // Update grade_status in assignments table
                $updateGradeSql = "UPDATE assignments SET grade_status = 'Graded' WHERE id = '$assignmentId'";
                if ($conn->query($updateGradeSql) === TRUE) {
                    echo "<script>alert('Marks updated successfully.');</script>";
                    echo '<script>window.location.href = "grading.php";</script>';
                } else {
                    echo "Error updating grade status: " . $conn->error;
                }
            } else {
                echo "Error updating marks: " . $conn->error;
            }
        } else {
            // Insert marks if they don't exist
            $insertSql = "INSERT INTO student_marks (id, student_email, module_name, assignment_title, marks) VALUES ('$assignmentId', '$studentEmail', '$moduleName', '$assignmentTitle', '$marks')";
            if ($conn->query($insertSql) === TRUE) {
                // Update grade_status in assignments table
                $updateGradeSql = "UPDATE assignments SET grade_status = 'Graded' WHERE id = '$assignmentId'";
                if ($conn->query($updateGradeSql) === TRUE) {
                    echo "<script>alert('Marks submitted successfully.');</script>";
                    echo '<script>window.location.href = "grading.php";</script>';
                } else {
                    echo "Error updating grade status: " . $conn->error;
                }
            } else {
                echo "Error inserting marks: " . $conn->error;
            }
        }
    } else {
        echo "<script>alert('Invalid request.');</script>";
    }
} else {
    echo "<script>alert('Method not allowed.');</script>";
}

$conn->close();
?>
