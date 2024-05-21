<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:../login.php");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "student");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve faculty information from the database
$sql = "SELECT * FROM faculty";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Faculty - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }


        h1 {
            margin-top: 100px;
            margin-left: 100px;
        }

        table {
            width: 100%;
            background-color: #fff;
            margin-left: 100px;
            
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: #333;
            color: #fff;
            
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav_sidebar.php'; ?>
    <!-- Display Faculty Table -->
    <div class="container mt-4">
        <h1>View Faculty</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Faculty ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['faculty_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['department'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td><button class='btn btn-primary' onclick='addModule(" . $row['faculty_id'] . ",\"" . $row['department'] . "\")'>Add Module</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No faculty found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript for the 'Add Module' functionality -->
    <script>
    function addModule(facultyId, department) {
        // Perform an action when the 'Add Module' button is clicked
        // Redirect to add_module.php and pass faculty ID and department as URL parameters
        window.location.href = "add_module.php?faculty_id=" + facultyId + "&department=" + department;
    }
</script>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
