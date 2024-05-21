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

$studentEmail = $_SESSION['email'];

$sqlCourse = "SELECT course FROM students WHERE email = '$studentEmail'";
$resultCourse = $conn->query($sqlCourse);

// Retrieve marks for the student
$sqlMarks = "SELECT module_name, assignment_title, marks
             FROM student_marks
             WHERE student_email = '$studentEmail'";

$resultMarks = $conn->query($sqlMarks);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Specific styles for the results section */
        
        .results-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            margin-top: 95px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .results-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            margin-top: 10px;
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
<?php include 'student_nav_sidebar.php'; ?>
    <div class="results-container">
        <?php if ($resultCourse && $resultCourse->num_rows > 0) {
            $course = $resultCourse->fetch_assoc();
            echo "<h1>{$course['course']}</h1>";
        } else {
            echo "<h1>Course Name</h1>";
        } ?>
        <?php if ($resultMarks && $resultMarks->num_rows > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Module Name</th>
                        <th>Assignment Title</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultMarks->num_rows > 0) {
                        $count = 1;
                        while ($row = $resultMarks->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['module_name']; ?></td>
                                <td><?php echo $row['assignment_title']; ?></td>
                                <td><?php echo $row['marks']; ?></td>
                            </tr>
                            <?php $count++;
                        endwhile;
                    } else { ?>
                        <tr>
                            <td colspan="4" class="no-marks">No marks found for this student.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

   
</body>

</html>
