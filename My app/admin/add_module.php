<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("location:../login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:../login.php");
}

// Initialize variables
$facultyId = $department = '';
$result = null;


// Retrieve faculty_id and department from the URL parameters
if (isset($_GET['faculty_id']) && isset($_GET['department'])) {
    $facultyId = $_GET['faculty_id'];
    $department = $_GET['department'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "student");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch modules based on the department from the courses table
    $sql = "SELECT * FROM courses WHERE department = '$department'";
    $result = $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['facultyId'], $_POST['moduleSelect'])) {
        $facultyId = $_POST['facultyId'];
        $selectedModule = $_POST['moduleSelect'];

        // Database connection
        $conn = new mysqli("localhost", "root", "", "student");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the selected module is already assigned to the faculty
        $checkQuery = "SELECT * FROM faculty_modules WHERE faculty_id = '$facultyId' AND selected_module = '$selectedModule'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            // Module already assigned, show an error message or handle this scenario
            echo "<script>alert('This module is already assigned to the faculty!');</script>";
            echo '<script>window.location.href = "view_faculty.php";</script>';
        } else {
            // Proceed with assigning the module to the faculty
            $emailQuery="SELECT email from faculty where faculty_id='$facultyId'";
            $emailResult=$conn->query($emailQuery);
            $row = $emailResult->fetch_assoc();
            $email=$row['email'];
            $insertQuery = "INSERT INTO faculty_modules (faculty_id,faculty_email, selected_module) VALUES ('$facultyId', '$email', '$selectedModule')";
            if ($conn->query($insertQuery) === TRUE) {
                // Trigger an alert message after successful addition
                echo "<script>alert('Module added to the faculty successfully!');</script>";
                // Redirect after successful submission
                echo '<script>window.location.href = "view_faculty.php";</script>';
                exit;
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
        
        $conn->close();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Module - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container1 {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'admin_nav_sidebar.php'; ?>
    <!-- Display Modules Dropdown -->
    <div class="container1 mt-4">
        <h1>Add Module</h1>
        <h2>Modules for Department: <?php echo $department; ?></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="moduleSelect">Select Module:</label>
                <select class="form-control" id="moduleSelect" name="moduleSelect">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            for ($i = 1; $i <= 4; $i++) {
                                $moduleColumn = "module" . $i;
                                $module = $row[$moduleColumn];
                                if ($module) {
                                    echo "<option value='" . $module . "'>" . $module . "</option>";
                                }
                            }
                        }
                    } else {
                        echo "<option value=''>No modules found for this department</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="facultyId" value="<?php echo $facultyId; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <!-- ... -->
    
    
</body>
</html>
