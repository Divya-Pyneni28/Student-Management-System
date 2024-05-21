<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection (replace these with your database credentials)
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

    // Fetch data from POST request
    $courseName = $_POST['courseName'];
    $department=$_POST['department'];
    $duration = $_POST['duration'];
    $fee = $_POST['fee'];
    $module1 = $_POST['module1'];
    $module2 = $_POST['module2'];
    $module3 = $_POST['module3'];
    $module4 = $_POST['module4'];

    // Insert data into the database
    $sql = "INSERT INTO courses (course_name, department, duration, fee, module1, module2, module3, module4)
            VALUES ('$courseName','$department', '$duration', '$fee', '$module1', '$module2', '$module3', '$module4')";

    if ($conn->query($sql) === TRUE) {
        header("Location: add_course.php?success=true");
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
