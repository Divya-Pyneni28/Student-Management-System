<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:../login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location:../login.php");
}

// Fetch user details from the database based on the email in the session
$email = $_SESSION['email']; // Retrieve logged-in student's email

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details using the email
$userQuery = "SELECT * FROM students WHERE email='$email'";
$userResult = $conn->query($userQuery);

if ($userResult->num_rows > 0) {
    $row = $userResult->fetch_assoc();
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $phone = $row['phone'];
    $nationality = $row['nationality'];
    $email=$row['email'];
    $password=$row['password'];
    // Add other fields as needed
} else {
    echo "No user details found for this student.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;      
        }

        .main-content {
            margin-left: 400px;
            padding: 20px;
            margin-right: 400px;
            margin-top: 65px;
            background-color: cornsilk;
        }

        h1 {
            
            margin-bottom: 30px;
            color: #333;
            text-align: center;
            background-color: bisque;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            
        }

        input[type="text"]:read-only,
        input[type="email"]:read-only {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-bottom: 20px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'student_nav_sidebar.php'; ?>

    <div class="main-content">
        <h1>User Profile</h1>
        <form action="update_profile.php" method="post">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $nationality; ?>" readonly>
            </div>
            <!-- Add other fields here -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
