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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !empty($_POST['module_name']) && isset($_FILES["assignment_file"])) {
    $module_name = $_POST['module_name'];
    $student_email = $_SESSION['email'] ?? '';

    // Validate and process the assignment submission
    // Replace this with your logic to handle the assignment submission
    if (!empty($student_email) && !empty($module_name)) {
        // File upload logic
        $targetDir = "./assignments/"; // Directory where assignment files will be uploaded

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $assignmentFile = $_FILES["assignment_file"];
        $fileName = basename($assignmentFile["name"]);
        $targetFile = $targetDir . $fileName;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check file size, type, etc. - Add your own validation rules here

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($assignmentFile["tmp_name"], $targetFile)) {
                // Update assignment_submitted_by_student to 'Yes' in the database
                $updateQuery = "UPDATE assignments SET assignment_submitted_by_student = 'Yes', assignment_file = '$fileName' WHERE student_email = '$student_email' AND module_name = '$module_name'";
    
                if ($conn->query($updateQuery) === TRUE) {
                    echo "<script>alert('The file " . htmlspecialchars($fileName) . " has been submitted successfully.');</script>";
                } else {
                    echo "Sorry, there was an error updating the database.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Email or module name not found.";
    }
}
$conn->close();
?>
