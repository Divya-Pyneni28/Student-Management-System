<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM faculty WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include 'faculty_nav_sidebar.php'; ?>
    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Welcome <?php echo $firstName; ?> </h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Course Management
                    </div>
                    <div class="card-body">
                        <p>Course Management and Module functionalities here</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Student Management
                    </div>
                    <div class="card-body">
                        <p>Student Management functionalities here</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Grading and Assessments
                    </div>
                    <div class="card-body">
                        <p>Grading and Assessments functionalities here</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Communication
                    </div>
                    <div class="card-body">
                        <p>Communication functionalities here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>