<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted and file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $course = $_POST["course"];
    $module = $_POST["module"];

    $fileName = $_FILES["fileToUpload"]["name"];
    $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
    $fileError = $_FILES["fileToUpload"]["error"];

    // Validate and process the uploaded file
    // Your existing code...

if ($fileError === 0) {
    $uploadDir = "uploads/"; // Directory where files will be stored

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory recursively
    }

    $filePath = $uploadDir . basename($fileName);

    // Move uploaded file to the desired directory
    if (move_uploaded_file($fileTmpName, $filePath)) {
        $sql = "INSERT INTO files (course, module, file_name, file_path) VALUES ('$course', '$module', '$fileName', '$filePath')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("File Uploaded successfully.");</script>';
                echo '<script>window.location.href = "upload_material.php";</script>'; // Redirect to home page
        exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Error: " . $_FILES["fileToUpload"]["error"];
}

} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
