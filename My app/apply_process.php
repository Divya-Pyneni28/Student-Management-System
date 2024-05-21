<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head content -->
</head>

<body>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform necessary validations
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $nationality = $_POST['nationality'];
    $selectedCourse = $_POST['selectedCourse'];


    if (strlen($mobileNumber) !== 10) {
        $error = "Mobile number should be 10 digits only.";
        // Redirect back to the form with an error message
        header("Location: apply.php?error=" . urlencode($error));
        exit();
    }
    // Prepare SQL statement for insertion into 'applications' table
    $sql = "INSERT INTO applications (first_name, last_name, mobile_number, email, nationality, selected_course)
            VALUES ('$firstName', '$lastName', '$mobileNumber', '$email', '$nationality', '$selectedCourse')";

    if ($conn->query($sql) === TRUE) {
        // Successful insertion
        echo '<script>alert("You have submitted your application successfully.");</script>';
        echo '<script>window.location.href = "index.php";</script>'; // Redirect to home page
        exit();
    } else {
        // Error in insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

</body>

</html>
