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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module Page</title>
    <!-- Include your CSS and other necessary files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .main-content {
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h1,
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            margin-bottom: 15px;
            font-size: 20px;
        }

        ul li a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }

        ul li a:hover {
            color: #0056b3;
        }

        .submit-button {
            display: block;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: #333;
            font-size: 18px;
        }
        .message-box {
                background-color: #f7f7f7;
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .message-box h2 {
                color: #007bff;
                margin-bottom: 10px;
            }

            .message-box p {
                font-size: 16px;
            }
    </style>
</head>

<body>
    <?php include 'student_nav_sidebar.php'; ?>

    <div class="main-content">
        <?php
        $selected_module = $_GET['module_id'] ?? '';

        if (!empty($selected_module)) {
            $sqlModule = "SELECT * FROM materials WHERE module_name = '$selected_module'";
            $resultModule = $conn->query($sqlModule);
            $student_email = $_SESSION['email'] ?? '';

            if ($resultModule && $resultModule->num_rows > 0) {
                echo "<h1>Materials for $selected_module</h1>";
                echo "<ul>";
                while ($row = $resultModule->fetch_assoc()) {
                    $file_path = "../faculty/uploads/" . $row['file_name'];
                    $file_name = $row['file_name'];
                
                    echo "<li>$file_name ";
                    echo "<a href='#' class='download-link' data-file-path='" . urlencode($file_path) . "'>Download</a>";
                    echo "</li>";
                }
                
                
                echo "</ul>";
            } else {
                echo "<p>No materials uploaded for this module.</p>";
            }
            if (!empty($student_email)) {
                $checkAssignmentQuery = "SELECT * FROM assignments WHERE student_email = '$student_email' AND module_name = '$selected_module'";
                $checkAssignmentResult = $conn->query($checkAssignmentQuery);
                echo "<div class='message-box'>";
                if ($checkAssignmentResult && $checkAssignmentResult->num_rows > 0) {
                    $assignment = $checkAssignmentResult->fetch_assoc();
                    if ($assignment['assignment_submitted_by_student'] == 'Yes') {
                        echo "<h2>Assignment Submitted</h2>";
                        echo "<p>You have already submitted your assignment. Please wait for the results.</p>";
                    } else {
                        echo "<h2>Submit Assignment</h2>";
                        echo "<form action='submit_assignment.php' method='post' enctype='multipart/form-data'>";
                        echo "<input type='hidden' name='module_name' value='$selected_module'>";
                        echo "<input type='file' name='assignment_file'>";
                        echo "<input type='submit' name='submit' value='Submit Assignment'>";
                        echo "</form>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No assignment has been assigned for this module.</p>";
                }
            } else {
                echo "<p>Email not found.</p>";
            }
        } else {
            echo "<p>Module name not found.</p>";
        }

        $conn->close();
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap scripts or other JS scripts -->
</body>

</html>



<script>
    // JavaScript to handle file download
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('download-link')) {
            e.preventDefault();
            let file_path = e.target.getAttribute('data-file-path');
            downloadFile(file_path);
        }
    });

    function downloadFile(file_path) {
        window.location.href = 'download_file.php?file_path=' + encodeURIComponent(file_path);
    }
</script>