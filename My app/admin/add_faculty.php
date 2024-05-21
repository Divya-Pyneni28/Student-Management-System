<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: ../login.php");
} elseif ($_SESSION['usertype'] == 'student') {
    header("location: ../login.php");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; // Password for XAMPP's MySQL root user
    $dbname = "student"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password=$_POST['password'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $country = $_POST['country'];
    $userType = $_POST['userType'];
    $username = strtolower(str_replace(' ', '', $firstName));

    // SQL query to insert data into the faculty table
    $sql1 = "INSERT INTO faculty (first_name, last_name, email, phone, department, country) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$department', '$country')";
    $sql2 = "INSERT INTO users (username, email, password, usertype) 
VALUES ('$username', '$email', '$password', '$userType')";
    
    if (($conn->query($sql1) === TRUE)&&($conn->query($sql2) === TRUE)) {
        echo '<script>alert("A Faculty has been added to the database");</script>';
        echo '<script>window.location.href = "add_faculty.php";</script>'; // Redirect to home page
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Faculty - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .main-content {
            margin: 20px;
        }
        h2{
            text-align: center;
            margin-top: 100px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 250px;
            margin-right: 200px;
            margin-top: 20px;
            margin-bottom: 20px;
            
        }

        .form-group {
            
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        button[type="submit"] {
            margin-top: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'admin_nav_sidebar.php'; ?>
    <div class="container mt-4">
        <h2>Add Faculty</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department">
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country">
            </div>
            <div class="form-group">
                <label for="userType">User Type</label>
                <input type="text" class="form-control" id="userType" name="userType" value="faculty" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Add Faculty</button>
        </form>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
