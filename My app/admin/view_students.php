<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Students - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 70px;
        }

        .main-content {
            margin: 300px;
            margin-top: 50px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-results {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav_sidebar.php'; ?>

    <div class="main-content" style="margin-top: 70px;">
        <h1>View Students</h1>
        <form method="GET" action="">
            <div class="form-group">
                <label for="admissionId">Admission ID</label>
                <input type="text" class="form-control" id="admissionId" name="admission_id">
            </div>
            <div class="form-group">
                <label for="course">Select Course</label>
                <select class="form-control" id="course" name="course">
                    <option value="">Select a course</option>
                    <option value="Introduction to Computer Science">Introduction to Computer Science</option>
                    <option value="Business Administration">Business Administration</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Psychology">Psychology</option>
                    <!-- Add more course options here -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </form>

        <!-- PHP code to fetch student details -->
        <?php
// Perform database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted and handle the search
if (isset($_GET['search'])) {
    $admission_id = $_GET['admission_id'] ?? '';
    $course = $_GET['course'] ?? '';

    if (!empty($admission_id)) {
        $sql = "SELECT * FROM students WHERE admission_id = '$admission_id'";
    } elseif (!empty($course)) {
        $sql = "SELECT * FROM students WHERE course = '$course'";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Admission ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Mobile</th><th>Course</th><th>Duration</th><th>Fee</th><th>Nationality</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['admission_id'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>' . $row['course'] . '</td>';
            
            // Fetch course details from the 'courses' table based on the course name
            $courseName = $row['course'];
            $courseDetailsQuery = "SELECT duration, fee FROM courses WHERE course_name = '$courseName'";
            $courseDetailsResult = $conn->query($courseDetailsQuery);
            if ($courseDetailsResult && $courseDetailsResult->num_rows > 0) {
                $courseDetails = $courseDetailsResult->fetch_assoc();
                echo '<td>' . $courseDetails['duration'] . '</td>';
                echo '<td>' . $courseDetails['fee'] . '</td>';
            } else {
                echo '<td colspan="2">Course details not found</td>';
            }
            
            echo '<td>' . $row['nationality'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="no-results">No results found.</p>';
    }
    
}

$conn->close();
?>
    </div>
    <!-- Bootstrap scripts -->
</body>

</html>
