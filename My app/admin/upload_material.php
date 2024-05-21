<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$coursesQuery = "SELECT course_name, module1, module2, module3, module4 FROM courses";
$coursesResult = $conn->query($coursesQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Upload Materials</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
        body{
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 20px;
        }

        /* Adjusted styling */
        .courses {
            /* Removed display: grid */
            gap: 20px;
        }

        .course-card {
            padding: 20px;
            margin-left: 80px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            display: block; /* Added display: block */
            margin-bottom: 20px; /* Added margin to separate cards */
        }

        .course-card a {
            text-decoration: none;
            color: #333;
        }

        .course-card a:hover {
            color: #555;
        }

        .course-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .course-modules {
            font-size: 14px;
            color: #666;
        }

        #selectedCourse {
            font-size: 24px;
            margin-top: 20px;
        }

        #modules {
            font-size: 18px;
            color: #555;
        }
    </style>
    <script>
        function showModules(course, modules) {
            document.getElementById("selectedCourse").innerHTML = "Course: " + course;

            const modulesList = document.getElementById("modulesList");
            modulesList.innerHTML = "";
            const moduleArray = modules.split(", ");
            moduleArray.forEach((module) => {
                const li = document.createElement("li");
                li.textContent = module;
                modulesList.appendChild(li);
            });
        }
    </script>
</head>

<body>
    <?php include 'admin_nav_sidebar.php'; ?>

    <div class="container" style="margin-top: 70px;">
        <h1>All Available Courses</h1>
        <div class="courses">
           <!-- Within the PHP loop for courses -->
<?php
if ($coursesResult->num_rows > 0) {
    while ($row = $coursesResult->fetch_assoc()) {
        $courseName = $row['course_name'];
        $modules = $row['module1'] . ", " . $row['module2'] . ", " . $row['module3'] . ", " . $row['module4'];

        echo "<div class='card course-card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>$courseName</h5>";
        echo "<form action='upload_process.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='course' value='$courseName'>";
        echo "<label for='modules'>Select a Module:</label>";
        echo "<select name='module' id='modules'>";
        
        $moduleArray = explode(", ", $modules);
        foreach ($moduleArray as $module) {
            echo "<option value='$module'>$module</option>";
        }

        echo "</select>";
        echo "<input type='file' name='fileToUpload'>";
        echo "<input type='submit' value='Upload'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
}
?>


    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
