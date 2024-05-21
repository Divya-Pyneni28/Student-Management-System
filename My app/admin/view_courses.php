<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Courses</title>
    <!-- Include necessary stylesheets, scripts, or meta tags -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .course {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .course h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .course p {
            margin: 10px 0;
            color: #666;
        }
    </style>
</head>

<body>
<?php include 'admin_nav_sidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content" style="margin-top: 70px;">
        <h1>View Courses</h1>
        <!-- Display courses -->
        <?php
        // Establish connection (replace with your DB credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student"; // Replace with your actual database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to select all courses
        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        // Check if there are courses
        if ($result && $result->num_rows > 0) {
            // Output data of each course
            while ($row = $result->fetch_assoc()) {
                // Display course details
                echo "<div class='course'>";
                echo "<h2>Course Name: " . $row["course_name"] . "</h2>";
                echo "<p>Module 1: " . $row["module1"] . "</p>";
                echo "<p>Module 2: " . $row["module2"] . "</p>";
                echo "<p>Module 3: " . $row["module3"] . "</p>";
                echo "<p>Module 4: " . $row["module4"] . "</p>";
                // Add more fields as needed
                echo "<p>Duration: " . $row["duration"] . "</p>";
                echo "<p>Fee: " . $row["fee"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No courses found</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Other scripts -->
</body>

</html>
