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

$sql = "SELECT * FROM assignments WHERE faculty_email = '$facultyEmail'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $studentAssignments = [];

    while ($row = $result->fetch_assoc()) {
        $studentAssignments[] = $row;
    }
} else {
    $studentAssignments = []; // Assign an empty array if no assignments found
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Grading Page</title>
    <!-- Include your CSS and other necessary files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            margin-top: 80px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        td a:hover {
            background-color: #1565c0;
            color: #fff;

        }
    </style>
</head>

<body>
   
<?php include 'faculty_nav_sidebar.php'; ?>
    <div class="container mt-5">
        <h1>Assignments for Grading</h1>
        <?php if (count($studentAssignments) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Email</th>
                        <th>Module Name</th>
                        <th>Assignment Title</th>
                        <th>Deadline</th>
                        <th>Submitted</th>
                        <th>Grade Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studentAssignments as $assignment) : ?>
                        <tr>
                            <td><?php echo $assignment['student_email']; ?></td>
                            <td><?php echo $assignment['module_name']; ?></td>
                            <td><?php echo $assignment['assignment_title']; ?></td>
                            <td><?php echo $assignment['assignment_deadline']; ?></td>
                            <td><?php echo $assignment['created_at']; ?></td>
                            <td><?php echo $assignment['grade_status']; ?></td>
                            <td>
                                <?php if ($assignment['assignment_submitted_by_student'] == 'Yes') : ?>
                                    <a href="view_submission.php?assignment_id=<?php echo $assignment['id']; ?>">View Submission</a>
                                <?php else : ?>
                                    Not Submitted
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No assignments found for grading.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap scripts or other JS scripts -->
</body>

</html>
