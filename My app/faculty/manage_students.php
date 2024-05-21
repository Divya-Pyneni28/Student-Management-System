<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
    exit;
}

if ($_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'] ?? '';

if (!empty($email)) {
    $facultyModulesQuery = "SELECT selected_module FROM faculty_modules WHERE faculty_email = '$email'";
    $facultyModulesResult = $conn->query($facultyModulesQuery);

    if ($facultyModulesResult && $facultyModulesResult->num_rows > 0) {
        $modules = [];
        while ($row = $facultyModulesResult->fetch_assoc()) {
            $modules[] = $row['selected_module'];
        }

        $studentsDetails = [];

        foreach ($modules as $module) {
            if ($module !== null) {
                $enrolledStudentsQuery = "SELECT enrollments.student_email, enrollments.module_name, students.first_name, students.last_name, students.email 
                                          FROM enrollments 
                                          INNER JOIN students ON students.email = enrollments.student_email 
                                          WHERE enrollments.module_name = '$module'";
                $enrolledStudentsResult = $conn->query($enrolledStudentsQuery);

                if ($enrolledStudentsResult && $enrolledStudentsResult->num_rows > 0) {
                    while ($student = $enrolledStudentsResult->fetch_assoc()) {
                        $studentsDetails[] = $student;
                    }
                }
            }
        }

        if (!empty($studentsDetails)) {
            echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Enrolled Students - Faculty Dashboard</title>
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        h2 {
            margin-top: 20px;
            color: #333;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            margin-left:100px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .table td form {
            display: flex;
            align-items: center;
        }
        .table td form input[type='text'],
        .table td form input[type='date'],
        .table td form button {
            margin-right: 10px;
        }
        .table td form button {
            padding: 6px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .table td form button:hover {
            background-color: #0056b3;
        }
    </style>
                </head>
                <body>";
            include 'faculty_nav_sidebar.php';
            echo "<div class='container'>";
            echo "<h2>Enrolled Students</h2>";
            echo "<table class='table'>";
            echo "<thead class='thead-light'>";
            echo "<tr>";
            echo"<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Module</th>";
            echo "<th>Assign Task</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
        
        if (!empty($studentsDetails)) {
            foreach ($studentsDetails as $student) {
                echo "<tr>";
                echo "<td>{$student['first_name']} {$student['last_name']}</td>";
                echo "<td>{$student['email']}</td>";
                echo "<td>{$student['module_name']}</td>";
                echo "<td>"; // Adding the Assign Task column cell
                echo "<form action='process_assignment.php' method='POST'>";
                echo "<input type='hidden' name='student_email' value='{$student['email']}'>";
                echo "<input type='hidden' name='module_name' value='{$student['module_name']}'>";
                echo "<input type='text' name='assignment_title' placeholder='Assignment Title'>";
                echo "<input type='date' name='assignment_deadline'>";
                echo "<button type='submit'>Assign</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No students found for this module.</td></tr>";
        }
        
    echo "</tbody>";
echo "</table>";


            echo "</div>";

            echo "</body></html>";
        } else {
            echo "<p>No students enrolled in modules assigned to you.</p>";
        }
    } else {
        echo "<p>No modules assigned to you.</p>";
    }
} else {
    echo "<p>Email not found.</p>";
}

$conn->close();
?>
