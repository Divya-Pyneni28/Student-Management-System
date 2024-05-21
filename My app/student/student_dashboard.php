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
$sql = "SELECT * FROM students WHERE email='$email'";
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
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 85px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .card-body p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php include 'student_nav_sidebar.php'; ?>
    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Welcome <?php echo $firstName; ?>,</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card style=height: 180px; mb-4">
                    <div class="card-header">
                       My Module
                    </div>
                    <div class="card-body">
                        <p>Explore the list of available modules for enrollment along with the associated Materials & Assignments.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body"> 
                        <p>Update your Profile here</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Payment
                    </div>
                    <div class="card-body">
                        <p>Know your Fee details here</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Results
                    </div>
                    <div class="card-body">
                        <p>Results have been published here</p>
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
