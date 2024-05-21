<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: ../login.php");
}

// Assuming you have a database connection established
// Replace with your actual database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count students per course
$studentsPerCourseQuery = "SELECT course, COUNT(*) AS student_count FROM students GROUP BY course";
$studentsPerCourseResult = $conn->query($studentsPerCourseQuery);

// Query to get fee status
$feeStatusQuery = "SELECT status, COUNT(*) AS count FROM fee GROUP BY status";
$feeStatusResult = $conn->query($feeStatusQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Student Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       /* CSS Styles */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    
    margin: 0;
   
}
h1{
    text-align: center;
}

.container {
    width: 80%; /* Adjust width of the container */
    max-width: 1200px; /* Set maximum width if needed */
}
.charts-row {
    display: flex;
    justify-content: space-between; /* Align charts with space between */
    margin-top: 50px;
   
}
.chart-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px; /* Adjust height of the chart container */
    margin-top: 50px; /* Adjust top margin if needed */
    background-color: #f8f9fa; /* Background color for better visibility */
    border-radius: 8px; /* Border radius for a rounded look */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
    margin-right: 20px;
    padding-right: 50px;
}

.welcome-message {
    margin-top: 80px; /* Adjust top margin */
    padding-top: 20px;
}
    </style>
</head>

<body>
<?php include 'admin_nav_sidebar.php'; ?>
    <!-- Display for Number of Students per Course -->

        <div id='container'> 
        <div class="welcome-message">
            <h2>Welcome Admin</h2>
        </div> 
            <div class="charts-row">
                <div class="chart-container">
                 <canvas id="studentsPerCourseChart" width="200" height="150"></canvas>
                </div>

            <!-- Display for Fee Status -->
                <div class="chart-container">
                <canvas id="feeStatusChart" width="400" height="200"></canvas>
                 </div>
            </div>
        </div> 
    <script>
        // Data for Number of Students per Course chart
        <?php
        $courseLabels = [];
        $studentCounts = [];

        if ($studentsPerCourseResult->num_rows > 0) {
            while ($row = $studentsPerCourseResult->fetch_assoc()) {
                $courseLabels[] = $row['course'];
                $studentCounts[] = $row['student_count'];
            }
        }
        ?>

        var studentsPerCourseData = {
            labels: <?php echo json_encode($courseLabels); ?>,
            datasets: [{
                label: 'Number of Students per Course',
                data: <?php echo json_encode($studentCounts); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Data for Fee Status chart
        <?php
        $feeStatusLabels = [];
        $feeStatusCounts = [];

        if ($feeStatusResult->num_rows > 0) {
            while ($row = $feeStatusResult->fetch_assoc()) {
                $feeStatusLabels[] = $row['status'];
                $feeStatusCounts[] = $row['count'];
            }
        }
        ?>

        var feeStatusData = {
            labels: <?php echo json_encode($feeStatusLabels); ?>,
            datasets: [{
                label: 'Fee Status',
                data: <?php echo json_encode($feeStatusCounts); ?>,
                backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 159, 64, 0.5)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 159, 64, 1)'],
                borderWidth: 1
            }]
        };

        // Render charts
        var studentsPerCourseCtx = document.getElementById('studentsPerCourseChart').getContext('2d');
new Chart(studentsPerCourseCtx, {
    type: 'bar',
    data: studentsPerCourseData,
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allows the canvas to resize within its parent container
        tooltips: {
            enabled: true,
            mode: 'index',
            intersect: false
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: 'Courses'
                }
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: 'Number of Students'
                }
            }
        }
    }
});

var feeStatusCtx = document.getElementById('feeStatusChart').getContext('2d');
new Chart(feeStatusCtx, {
    type: 'pie',
    data: feeStatusData,
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allows the canvas to resize within its parent container
        tooltips: {
            enabled: true,
            mode: 'index',
            intersect: false
        }
    }
});
    </script>
</body>

</html>
