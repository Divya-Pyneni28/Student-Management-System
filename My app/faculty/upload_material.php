<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection (replace with your credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student"; // Replace with your database name
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $moduleName = $_POST['module'];

    // Handle file upload
    $targetDir = "uploads/"; // Directory where files will be uploaded
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

    $targetFile = $targetDir . basename($_FILES["materialFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (you can adjust the size limit as needed)
    if ($_FILES["materialFile"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (you can add more formats as needed)
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    // If the file was successfully uploaded, insert data into the materials table
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {

        if (isset($_SESSION['email'])) {
            $facultyEmail = $_SESSION['email'];
            $fileName = basename($_FILES["materialFile"]["name"]);
            if (move_uploaded_file($_FILES["materialFile"]["tmp_name"], $targetFile)) {
                // Insert material details into the materials table with faculty email
                $sql = "INSERT INTO materials (module_name, file_name, file_path, faculty_email) 
                        VALUES ('$moduleName', '$fileName', '$targetFile', '$facultyEmail')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script> alert('The file has been Uploaded successfully')</script>";
                    echo '<script>window.location.href = "manage_modules.php";</script>'; 
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Faculty email not found in the session.";
        }

    }

    $conn->close();
}


?>
