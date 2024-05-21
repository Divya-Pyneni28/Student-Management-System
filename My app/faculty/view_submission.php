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

$facultyEmail = $_SESSION['email'];

if (isset($_GET['assignment_id'])) {
    $assignmentId = $_GET['assignment_id'];

    $sql = "SELECT * FROM assignments WHERE id = '$assignmentId' AND faculty_email = '$facultyEmail'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $assignment = $result->fetch_assoc();
         $assignment['assignment_file'] = "../student/assignments/" . $assignment['assignment_file'];
    } else {
        // Handle assignment not found or unauthorized access
        header("location: grading.php");
        exit();
    }
} else {
    // Handle invalid assignment ID
    header("location: grading.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Submission</title>
    <!-- Include your CSS and other necessary files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        h1{
            text-align: center;
            margin-top: 80px;
        } 

        .card {
            border: none;
            margin-top: 20px;
            margin-right: 200px;
            margin-left: 200px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
           
        }

        p {
            color: #555;
        
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
            
        }

        a:hover {
            color: #0056b3;
            
        }

        label {
            
            margin-top: 20px;
            display: block;
            font-weight: bold;
            color: #333;
        }

        input[type="number"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'faculty_nav_sidebar.php'; ?>

    <div class="container mt-5">
        <h1>View Submission</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Assignment Details</h5>
                <p>Student Email: <?php echo $assignment['student_email']; ?></p>
                <p>Module Name: <?php echo $assignment['module_name']; ?></p>
                <p>Assignment Title: <?php echo $assignment['assignment_title']; ?></p>
                <p>Deadline: <?php echo $assignment['assignment_deadline']; ?></p>
                <p>Submitted: <?php echo $assignment['created_at']; ?></p>

                <?php if ($assignment['assignment_submitted_by_student'] == 'Yes') : ?>
                    <h5 class="card-title mt-4">Submitted File</h5>
                    <a href="../uploads/<?php echo $assignment['assignment_file']; ?>" target="_blank">View File</a>
                <?php else : ?>
                    <p>No file submitted.</p>
                <?php endif; ?>
                <!-- Add an input field for marks -->
                                
                <form action="submit_marks.php" method="post">
                    <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']; ?>">
                    <input type="hidden" name="student_email" value="<?php echo $assignment['student_email']; ?>">
                    <input type="hidden" name="module_name" value="<?php echo $assignment['module_name']; ?>">
                    <input type="hidden" name="assignment_title" value="<?php echo $assignment['assignment_title']; ?>">
                    <!-- Other fields or inputs here -->

                    <label for="marks">Enter Marks:</label>
                    <input type="number" id="marks" name="marks" required>
                    <br><br>
                    <input type="submit" value="Submit Marks">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap scripts or other JS scripts -->
</body>

</html>
