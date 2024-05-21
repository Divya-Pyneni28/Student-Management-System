<?php
session_start();

// Check for session and user type
if (!isset($_SESSION['email']) || $_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
    exit;
}

// Your database connection and any other necessary logic here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $file_id = $_GET['id'];

    // Prepare and execute SQL DELETE query
    $sql = "DELETE FROM materials WHERE id = $file_id";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo '<script>alert("File deleted successfully")<?script>';
        echo '<script>window.location.href = "manage_modules.php";</script>';
    } else {
        // Error in deletion
        echo "Error deleting file: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
