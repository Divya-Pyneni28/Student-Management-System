<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Modules - Student Panel</title>
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

        .modules {
            padding: 20px;
        }
        .info{
            text-align: center;
            margin-bottom: 20px;
        }

        .modules h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            padding-bottom: 20px;
        }

        .modules ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .modules ul li {
            margin-bottom: 15px;
            font-size: 20px;
        }

        .modules ul li a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
           
        }

        .modules ul li a:hover {
            color: #0056b3;
        }
        /* Style for the 'Enroll' button */
       
       .enroll-button {
            display: inline-block;
            margin-left: 20px;  
            
        }

        .enrolled {
            color: green;
            font-weight: bold;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<?php include 'student_nav_sidebar.php'; ?>

<div class="main-content">
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch modules based on the logged-in student's admission ID
    $email = $_SESSION['email'] ?? '';

    if (!empty($email)) {
        $sql = "SELECT course FROM students WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $course = $row['course'];

            // Fetch modules for the course
            $sqlModules = "SELECT module1, module2, module3, module4 FROM courses WHERE course_name = '$course'";
            $resultModules = $conn->query($sqlModules);

            if ($resultModules && $resultModules->num_rows > 0) {
                echo "<div class='modules'>";
                echo "<h2>Modules for $course</h2>";
                echo "<div class='info'>";
                echo "<p>To enroll in your modules, click the 'Enroll' button next to the module name.</p>";
                echo "</div>";
                echo "<ul>";
                $rowModules = $resultModules->fetch_assoc();
                foreach ($rowModules as $module) {
                    if ($module !== null) {
                        $isEnrolledQuery = "SELECT * FROM enrollments WHERE student_email = '$email' AND module_name = '$module'";
                        $isEnrolledResult = $conn->query($isEnrolledQuery);
                        $isEnrolled = ($isEnrolledResult && $isEnrolledResult->num_rows > 0);

                        echo "<li>";
                        echo "<a href='module_page.php?module_id=$module'>$module</a>";
                        if ($isEnrolled) {
                            echo "<span class='enrolled'>Enrolled</span>";
                        } else {
                            echo "<form style='display: inline-block;' method='post' action='enroll.php' class='enroll-button'>";
                            echo "<input type='hidden' name='module_name' value='$module'>";
                            echo "<input type='submit' name='enroll' value='Enroll'>";
                            echo "</form>";
                        }
                        echo "</li>";
                    }
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<p>No modules found for $course</p>";
            }
        } else {
            echo "<p>No course found for this student</p>";
        }
    } else {
        echo "<p>Admission ID not found</p>";
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

